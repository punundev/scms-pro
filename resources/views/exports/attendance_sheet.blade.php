<table>
  <thead>
    <tr>
      <th colspan="{{ count($dates) + 5 }}" style="text-align: center; font-weight: bold; font-size: 16pt;">
        MONTHLY ATTENDANCE RECORD
      </th>
    </tr>
    <tr>
      <th colspan="{{ count($dates) + 5 }}" style="text-align: center; font-size: 12pt;">
        {{ $course->subject->name }} ({{ $course->subject->code }})
      </th>
    </tr>

    <tr>
      <td colspan="2"><strong>Teacher:</strong> {{ $course->teacher->name }}</td>
      <td colspan="{{ count($dates) }}"><strong>Time:</strong> {{ $course->time_slot }}</td>
      <td colspan="3" align="right"><strong>Room:</strong> {{ $course->classroom->name ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Generated:</strong> {{ date('d-M-Y H:i') }}</td>
      <td colspan="{{ count($dates) }}"><strong>Month:</strong> {{ $dates->first()?->format('F Y') }}</td>
      <td colspan="3" align="right"><strong>School Management System</strong></td>
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
      <th colspan="{{ count($dates) }}"
        style="border: 2px solid #000000; background-color: #E2E8F0; text-align: center; font-weight: bold;">DATES</th>
      <th colspan="2"
        style="border: 2px solid #000000; background-color: #E2E8F0; text-align: center; font-weight: bold;">TOTAL</th>
    </tr>
    <tr>
      @foreach ($dates as $date)
        <th
          style="border: 1px solid #000000; text-align: center; background-color: #EDF2F7; width: 40px; font-weight: bold;">
          {{ $date->format('d') }}
        </th>
      @endforeach
      <th
        style="border: 2px solid #000000; background-color: #C6F6D5; text-align: center; font-weight: bold; width: 60px;">
        SCORE</th>
      <th
        style="border: 2px solid #000000; background-color: #FED7D7; text-align: center; font-weight: bold; width: 60px;">
        %</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($records as $studentId => $attendanceList)
      @php
        $student = $attendanceList->first()->student;
        $attendanceByDate = $attendanceList->keyBy(fn($item) => \Carbon\Carbon::parse($item->date)->toDateString());
        $totalScore = 0;
      @endphp
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ strtoupper($student->name) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">
          {{ strtoupper(substr($student->gender ?? 'M', 0, 1)) }}</td>

        @foreach ($dates as $date)
          @php
            $dayStr = $date->toDateString();
            $att = $attendanceByDate[$dayStr] ?? null;
            $display = '';
            $color = '#000000';
            $pts = 0;

            if ($att) {
                if ($att->status === 'attending') {
                    $display = 'P';
                    $pts = 1;
                    $color = '#2F855A';
                } elseif ($att->status === 'permission') {
                    $display = 'L';
                    $pts = 0.5;
                    $color = '#C05621';
                } elseif ($att->status === 'absence') {
                    $display = 'A';
                    $pts = 0;
                    $color = '#C53030';
                }
            }
            $totalScore += $pts;
          @endphp
          <td style="border: 1px solid #000000; text-align: center; color: {{ $color }}; font-weight: bold;">
            {{ $display }}
          </td>
        @endforeach

        <td style="border: 1px solid #000000; text-align: center; font-weight: bold; background-color: #F0FFF4;">
          {{-- {{ $totalScore }} --}}
          {{ count($dates) > 0 ? round(($totalScore / count($dates)) * 100) / 10 : 0 }}
        </td>
        <td style="border: 1px solid #000000; text-align: center; font-weight: bold; background-color: #FFF5F5;">
          {{ count($dates) > 0 ? round(($totalScore / count($dates)) * 100) : 0 }}%
        </td>
      </tr>
    @endforeach
  </tbody>

  <tfoot>
    <tr></tr>
    <tr>
      <td colspan="3" style="font-weight: bold;">LEGEND:</td>
      <td colspan="{{ count($dates) }}">
        <strong>P</strong> = Present (1.0) |
        <strong>L</strong> = Leave/Permission (0.5) |
        <strong>A</strong> = Absent (0.0)
      </td>
    </tr>
  </tfoot>
</table>
