<table>
  <thead>
    <tr>
      <th colspan="6" style="text-align: center; font-weight: bold; font-size: 16pt;">STUDENT ENROLLMENT REPORT</th>
    </tr>
    <tr></tr>
    <tr style="background-color: #4A5568;">
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">NO</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">STUDENT NAME</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">SUBJECT</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">ENROLLED DATE</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">FEE</th>
      <th style="border: 2px solid #000; background-color: #E2E8F0; font-weight: bold;">STATUS</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $enrollment)
      @php
        $statusColor = $enrollment->status === 'active' ? '#2F855A' : '#718096';
      @endphp
      <tr>
        <td style="border: 1px solid #000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000; font-weight: bold;">{{ strtoupper($enrollment->student->name) }}</td>
        <td style="border: 1px solid #000;">{{ $enrollment->courseOffering->subject->name }}</td>
        <td style="border: 1px solid #000;">{{ $enrollment->created_at->format('d-M-Y') }}</td>
        <td style="border: 1px solid #000;">${{ number_format($enrollment->courseOffering->fee, 2) }}</td>
        <td style="border: 1px solid #000; text-align: center; color: {{ $statusColor }}; font-weight: bold;">
          {{ strtoupper($enrollment->status) }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
