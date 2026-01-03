<html>

  <head>
    <style>
      body {
        font-family: 'Helvetica', sans-serif;
        color: #333;
      }

      .header {
        text-align: center;
        border-bottom: 2px solid #444;
        padding-bottom: 10px;
        margin-bottom: 20px;
      }

      .logo {
        font-size: 24pt;
        font-weight: bold;
        color: #1a202c;
      }

      .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        font-size: 9pt;
        text-align: center;
        border-top: 1px solid #ddd;
        padding: 10px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th {
        background: #2d3748;
        color: white;
        padding: 10px;
        font-size: 10pt;
      }

      td {
        padding: 8px;
        border: 1px solid #edf2f7;
        font-size: 9pt;
      }

      .page-break {
        page-break-after: always;
      }
    </style>
  </head>

  <body>
    <div class="header">
      <div class="logo">SCMS G2</div>
      <div style="font-size: 14pt;">{{ $title }}</div>
      <div style="font-size: 10pt;">Period: {{ request('start_date') }} to {{ request('end_date') }}</div>
    </div>

    @include($view)

    <div class="footer">
      Printed by {{ auth()->user()->name }} on {{ date('Y-m-d H:i:s') }} - Page 1 of 1
    </div>
  </body>

</html>
