<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\User;
use App\Notifications\FeeAssigned;
use App\Notifications\FeePaidNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class FeeController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Fee';
  }

  public function index(Request $request)
  {
    $search     = $request->input('search');
    $feeTypeId  = $request->input('fee_type_id');
    $status     = $request->input('status');
    $perPage    = $request->input('per_page', 12);

    $fees = Fee::query()
      ->with(['student:id,name,email', 'feeType:id,name'])
      ->when($feeTypeId, fn($q) => $q->where('fee_type_id', $feeTypeId))
      ->when($status, function ($q) use ($status) {
        if ($status === 'paid') {
          $q->whereNotNull('payment_date');
        } elseif ($status === 'unpaid') {
          $q->whereNull('payment_date');
        }
      })
      ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('remarks', 'like', "%{$search}%")
            ->orWhere('amount', 'like', "%{$search}%")
            ->orWhereHas('student', fn($s) =>
            $s->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%"))
            ->orWhereHas('feeType', fn($ft) =>
            $ft->where('name', 'like', "%{$search}%"));
        });
      })

      // ->orderByRaw("CASE WHEN payment_date IS NULL THEN 0 ELSE 1 END ASC")
      // ->orderByRaw("ABS(DATEDIFF(due_date, CURDATE())) ASC")
      // ->orderByRaw("CASE WHEN payment_date IS NULL THEN due_date END ASC")
      // ->orderBy('payment_date', 'desc')

      ->orderByRaw("
          CASE
            WHEN payment_date IS NULL AND due_date < CURDATE() THEN 0
            WHEN payment_date IS NULL THEN 1
            ELSE 2
          END ASC
        ")
      ->orderByRaw("due_date ASC")
      ->orderBy('payment_date', 'desc')


      ->paginate($perPage)
      ->appends($request->query());

    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = $feeTypeId ? $feeTypes->firstWhere('id', $feeTypeId) : null;

    $statuses = ['unpaid', 'paid'];

    return view('admin.fees.index', compact(
      'fees',
      'feeTypes',
      'feeTypeId',
      'selectedFeeType',
      'statuses',
      'status',
    ));
  }



  public function create(Request $request)
  {
    $students = User::role('student')->get(['id', 'name']);
    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $feeTypeId = $request->input('fee_type_id');
    $selectedFeeType = $feeTypeId ? FeeType::find($feeTypeId) : null;

    if ($students->isEmpty()) {
      return redirect()->route('admin.students.create')
        ->with('error', 'No students found. Please create a student first.');
    }

    return view('admin.fees.create', compact('students', 'feeTypes', 'selectedFeeType', 'feeTypeId'));
  }


  public function store(FeeRequest $request)
  {
    try {
      $data = $request->validated();
      $data['created_by'] = Auth::id();

      if (!isset($data['status'])) {
        $data['status'] = 'pending';
      }

      $fee = Fee::create($data);
      $fee->student->notify(new FeeAssigned($fee));

      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new FeeAssigned($fee));

      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $data['fee_type_id']])
        ->with('success', 'Fee record created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Fee: ' . $e->getMessage());
      return back()->with('error', 'Error creating fee record.')->withInput();
    }
  }

  public function paid(Request $request, Fee $fee)
  {
    $validated = $request->validate([
      'payment_method'  => 'required|string|max:50',
      'transaction_id'  => 'nullable|string|max:100',
      'payment_date'    => 'nullable|date',
    ]);

    $validated['payment_date'] = $validated['payment_date'] ?? now();
    $validated['received_by'] = Auth::id();

    $fee->update($validated);

    $notifiableUsers = User::role(['admin', 'staff'])->get();
    Notification::send($notifiableUsers, new FeePaidNotification($fee));

    return redirect()
      ->route('admin.fees.show', $fee->id)
      ->with('success', 'Payment has been recorded successfully!');
  }


  public function show(Fee $fee)
  {
    $fee->load(['student', 'feeType', 'creator']);
    return view('admin.fees.show', compact('fee'));
  }

  public function edit(Fee $fee)
  {

    $students = User::role('student')->get(['id', 'name']);
    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = FeeType::find($fee->fee_type_id);
    $feeTypeId = $fee->fee_type_id;

    if ($students->isEmpty()) {
      return redirect()->route('admin.students.create')
        ->with('error', 'No students found. Please create a student first.');
    }

    return view('admin.fees.edit', compact('fee', 'students', 'feeTypes', 'selectedFeeType', 'feeTypeId'));
  }

  public function update(FeeRequest $request, Fee $fee)
  {
    try {
      $data = $request->validated();
      $fee->update($data);

      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $data['fee_type_id']])
        ->with('success', 'Fee record updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating Fee: ' . $e->getMessage());
      return back()->with('error', 'Error updating fee record.')->withInput();
    }
  }

  public function destroy(Fee $fee)
  {
    $feeTypeId = $fee->fee_type_id;

    try {
      $fee->delete();
      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $feeTypeId])
        ->with('success', 'Fee record deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Fee: ' . $e->getMessage());
      return back()->with('error', 'Error deleting fee record.');
    }
  }
}
