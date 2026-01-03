<table>
  <thead>
    <tr>
      <th colspan="7" style="text-align: center; font-weight: bold; font-size: 16pt;">
        OFFICIAL EXAMINATION RESULT SHEET
      </th>
    </tr>
    <tr>
      <th colspan="7" style="text-align: center; font-size: 13pt; color: #4A5568;">
        {{ strtoupper($exam->type) }} - {{ $exam->courseOffering->subject->name }}
      </th>
    </tr>
    <tr></tr>

    <tr>
      <td colspan="2"><strong>Instructor:</strong> {{ $exam->courseOffering->teacher->name }}</td>
      <td colspan="3"><strong>Date:</strong> {{ \Carbon\Carbon::parse($exam->date)->format('d M, Y') }}</td>
      <td colspan="2" align="right"><strong>Total Marks:</strong> {{ $exam->total_marks }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Classroom:</strong> {{ $exam->courseOffering->classroom->name ?? 'N/A' }}</td>
      <td colspan="3"><strong>Schedule:</strong> {{ $exam->courseOffering->time_slot }}</td>
      <td colspan="2" align="right" style="color: #E53E3E;"><strong>Passing Marks:</strong>
        {{ $exam->passing_marks }}</td>
    </tr>
    <tr></tr>

    <tr style="background-color: #2D3748; color: #ffffff;">
      <th style="border: 2px solid #000000; font-weight: bold; text-align: center;">NO</th>
      <th style="border: 2px solid #000000; font-weight: bold; text-align: center;">STUDENT ID</th>
      <th style="border: 2px solid #000000; font-weight: bold;">FULL NAME</th>
      <th style="border: 2px solid #000000; font-weight: bold; text-align: center;">SEX</th>
      <th style="border: 2px solid #000000; font-weight: bold; text-align: center;">SCORE</th>
      <th style="border: 2px solid #000000; font-weight: bold; text-align: center;">GRADE</th>
      <th style="border: 2px solid #000000; font-weight: bold;">REMARKS</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($scores as $score)
      @php
        $isPassed = $score->score >= $exam->passing_marks;
        $scoreColor = $isPassed ? '#2F855A' : '#C53030'; // Green if pass, Red if fail
      @endphp
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $score->student->id }}</td>
        <td style="border: 1px solid #000000;">{{ strtoupper($score->student->name) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">
          {{ strtoupper(substr($score->student->gender ?? 'M', 0, 1)) }}</td>

        <td style="border: 1px solid #000000; text-align: center; font-weight: bold; color: {{ $scoreColor }};">
          {{ $score->score }}
        </td>

        <td style="border: 1px solid #000000; text-align: center; font-weight: bold;">
          {{ $score->grade }}
        </td>

        <td style="border: 1px solid #000000; font-style: italic;">
          {{ $score->remarks ?? ($isPassed ? 'Passed' : 'Failed / Retake Required') }}
        </td>
      </tr>
    @endforeach
  </tbody>

  <tfoot>
    <tr></tr>
    <tr>
      <td colspan="3" style="font-weight: bold;">Summary:</td>
      <td colspan="4">
        Total Students: {{ $scores->count() }} |
        Passed: {{ $scores->where('score', '>=', $exam->passing_marks)->count() }} |
        Failed: {{ $scores->where('score', '<', $exam->passing_marks)->count() }}
      </td>
    </tr>
  </tfoot>
</table>
