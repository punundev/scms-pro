<table>
  <thead>
    <tr>
      <th colspan="6" style="text-align: center; font-weight: bold; font-size: 16pt;">FINANCIAL EXPENSE REPORT</th>
    </tr>
    <tr>
      <td colspan="2"><strong>Generated:</strong> {{ date('d-M-Y') }}</td>
      <td colspan="2"><strong>Total Amount:</strong> ${{ number_format($data['summary']['total'], 2) }}</td>
      <td colspan="2" align="right"><strong>Count:</strong> {{ $data['summary']['count'] }} Items</td>
    </tr>
    <tr></tr>
    <tr style="background-color: #2D3748; color: #ffffff;">
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">NO</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">DATE</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">CATEGORY</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">DESCRIPTION</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">CREATED BY</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">AMOUNT</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data['list'] as $expense)
      <tr>
        <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000;">{{ \Carbon\Carbon::parse($expense->date)->format('d-M-Y') }}</td>
        <td style="border: 1px solid #000;">{{ $expense->category->name }}</td>
        <td style="border: 1px solid #000;">{{ $expense->description }}</td>
        <td style="border: 1px solid #000;">{{ $expense->creator->name }}</td>
        <td style="border: 1px solid #000; font-weight: bold; color: #C53030;">${{ number_format($expense->amount, 2) }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
