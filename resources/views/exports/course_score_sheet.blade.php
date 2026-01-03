<table>
  <thead>
    <tr>
      <th colspan="12" style="text-align: center; font-weight: bold; font-size: 16pt;">
        OFFICIAL SCORE REPORT
      </th>
    </tr>
    <tr>
      <th colspan="12" style="text-align: center; font-size: 12pt;">
        {{ $course->subject->name }} ({{ $course->subject->code }})
      </th>
    </tr>

    <tr>
      <td colspan="3"><strong>Teacher:</strong> {{ $course->teacher->name }}</td>
      <td colspan="5"><strong>Time:</strong> {{ $course->time_slot }}</td>
      <td colspan="4" align="right"><strong>Room:</strong> {{ $course->classroom->name ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td colspan="3"><strong>Generated:</strong> {{ date('d-M-Y H:i') }}</td>
      <td colspan="5"><strong>Academic Year:</strong> {{ now()->format('Y') }}</td>
      <td colspan="4" align="right"><strong>School Management System</strong></td>
    </tr>
    <tr></tr>
    <tr>
      <th rowspan="2"
        style="border: 2px solid #000000; background-color: #E2E8F0; text-align: center; vertical-align: middle; font-weight: bold;">
        NO</th>
      <th rowspan="2"
        style="border: 2px solid #000000; background-color: #E2E8F0; vertical-align: middle; font-weight: bold;">STUDENT
        NAME</th>
      <th rowspan="2"
        style="border: 2px solid #000000; background-color: #E2E8F0; text-align: center; vertical-align: middle; font-weight: bold;">
        SEX</th>
      <th colspan="7"
        style="border: 2px solid #000000; background-color: #E2E8F0; text-align: center; font-weight: bold;">ASSESSMENT
        COMPONENTS</th>
      <th colspan="2"
        style="border: 2px solid #000000; background-color: #E2E8F0; text-align: center; font-weight: bold;">RESULT</th>
    </tr>
    <tr>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">ATT (10%)
      </th>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">LIS</th>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">REA</th>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">WRI</th>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">SPE</th>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">MID</th>
      <th style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; font-weight: bold;">FIN</th>
      <th style="border: 2px solid #000000; background-color: #C6F6D5; text-align: center; font-weight: bold;">TOTAL
      </th>
      <th style="border: 2px solid #000000; background-color: #BEE3F8; text-align: center; font-weight: bold;">GRADE
      </th>
    </tr>
  </thead>

  <tbody>
    @foreach ($enrollments as $enrollment)
      @php
        $student = $enrollment->student;
        $total = $enrollment->manual_sum;
        $isPassed = $total >= 50;
      @endphp
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ strtoupper($student->name) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">
          {{ strtoupper(substr($student->gender ?? 'M', 0, 1)) }}
        </td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->attendance_grade }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->listening_grade }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->reading_grade }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->writing_grade }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->speaking_grade }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->midterm_grade }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ $enrollment->final_grade }}</td>

        <td
          style="border: 1px solid #000000; text-align: center; font-weight: bold; background-color: {{ $isPassed ? '#F0FFF4' : '#FFF5F5' }};">
          {{ number_format($total, 2) }}
        </td>
        <td style="border: 1px solid #000000; text-align: center; font-weight: bold;">
          {{ $enrollment->letter_grade }}
        </td>
      </tr>
    @endforeach
  </tbody>

  <tfoot>
    <tr></tr>
    <tr>
      <td colspan="3" style="font-weight: bold;">LEGEND:</td>
      <td colspan="9">
        ATT: Attendance | LIS: Listening | REA: Reading | WRI: Writing | SPE: Speaking | MID: Midterm | FIN: Final
      </td>
    </tr>
  </tfoot>
</table>
