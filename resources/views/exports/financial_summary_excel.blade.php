<table>
  <thead>
    <tr>
      <th colspan="3" style="font-weight: bold; font-size: 14pt;">Financial Summary Report</th>
    </tr>
    <tr>
      <th>Total Income:</th>
      <th style="color: #28a745;">{{ number_format($data['total_income'], 2) }}</th>
    </tr>
    <tr>
      <th>Total Expenses:</th>
      <th style="color: #dc3545;">{{ number_format($data['total_expenses'], 2) }}</th>
    </tr>
    <tr>
      <th>Net Profit:</th>
      <th style="font-weight: bold;">{{ number_format($data['total_income'] - $data['total_expenses'], 2) }}</th>
    </tr>
    <tr></tr>

    <tr style="background-color: #d4edda;">
      <th colspan="3" style="font-weight: bold; border: 1px solid #000;">INCOME (FEES)</th>
    </tr>
    <tr>
      <th style="border: 1px solid #000; font-weight: bold;">Date</th>
      <th style="border: 1px solid #000; font-weight: bold;">Description</th>
      <th style="border: 1px solid #000; font-weight: bold;">Amount</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data['income'] as $income)
      <tr>
        <td style="border: 1px solid #000;">{{ $income->created_at->format('Y-m-d') }}</td>
        <td style="border: 1px solid #000;">Fee Payment - {{ $income->student->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000;">{{ number_format($income->amount, 2) }}</td>
      </tr>
    @endforeach
    <tr></tr>

    <tr style="background-color: #f8d7da;">
      <th colspan="3" style="font-weight: bold; border: 1px solid #000;">EXPENSES</th>
    </tr>
    <tr>
      <th style="border: 1px solid #000; font-weight: bold;">Date</th>
      <th style="border: 1px solid #000; font-weight: bold;">Category</th>
      <th style="border: 1px solid #000; font-weight: bold;">Amount</th>
    </tr>
    @foreach ($data['expenses'] as $expense)
      <tr>
        <td style="border: 1px solid #000;">{{ $expense->date }}</td>
        <td style="border: 1px solid #000;">{{ $expense->category->name ?? 'General' }}</td>
        <td style="border: 1px solid #000;">{{ number_format($expense->amount, 2) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
