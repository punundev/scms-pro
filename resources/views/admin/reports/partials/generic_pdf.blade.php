<!DOCTYPE html>
<html>

  <head>
    <style>
      body {
        font-family: sans-serif;
        font-size: 12px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
      }

      th,
      td {
        border: 1px solid #333;
        padding: 6px;
        text-align: left;
      }

      th {
        background: #f2f2f2;
      }
    </style>
  </head>

  <body>

    <h2 style="text-align:center;">Report</h2>

    <table>
      <thead>
        <tr>
          @foreach ($columns as $col)
            <th>{{ $col }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $row)
          <tr>
            @foreach ($columns as $col)
              @php
                $key = strtolower(str_replace(' ', '_', $col));
              @endphp
              <td>{{ data_get($row, $key) }}</td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>

  </body>

</html>
