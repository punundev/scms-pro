<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Subject';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 12);

    $subjects = Subject::withTrashed()
      ->when($search, function ($query) use ($search) {
        return $query->where('name', 'like', "%{$search}%")
          ->orWhere('code', 'like', "%{$search}%")
          ->orWhere('credit_hours', 'like', "%{$search}%");
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.subjects.index', compact('subjects'));
  }

  public function create()
  {
    return view('admin.subjects.create');
  }

  public function store(SubjectRequest $request)
  {
    try {
      Subject::create($request->validated());
      return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating subject: ' . $e->getMessage());
      return redirect()->route('admin.subjects.create')->with('error', 'Error creating subject.')->withInput();
    }
  }

  public function edit(Subject $subject)
  {
    return view('admin.subjects.edit', compact('subject'));
  }

  public function update(SubjectRequest $request, Subject $subject)
  {
    try {
      $subject->update($request->validated());
      return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating subject: ' . $e->getMessage());
      return redirect()->route('admin.subjects.edit', $subject)->with('error', 'Error updating subject.')->withInput();
    }
  }

  public function destroy(Subject $subject)
  {
    try {
      $subject->delete();
      return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting subject: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting subject: ' . $e->getMessage());
    }
  }

  public function restore($id)
  {
    try {
      $subject = Subject::onlyTrashed()->findOrFail($id);
      $subject->restore();

      return redirect()
        ->route('admin.subjects.index')
        ->with('success', 'subject restored successfully');
    } catch (\Exception $e) {
      Log::error('Error restoring subject: ' . $e->getMessage());

      return redirect()
        ->back()
        ->with('error', 'Error restoring subject');
    }
  }
}
