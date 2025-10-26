<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Login {{ $date }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
        }

        .report-header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .chart-wrapper {
            width: 100%;
            margin-bottom: 1rem;
        }

        table {
            font-size: 12px;
        }

        th,
        td {
            padding: 6px;
        }
    </style>
</head>

<body class='container'>
    <div class="report-header">
        <h4>Detail Login User</h4>
        <div>{{ $date }}</div>
    </div>

    <h5>Data Login</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pengguna</th>
                <th>Ip address</th>
                <th>Detail Perangkat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logins as $login)
                <tr>
                    <td>{{ $login['usr_lg_logged_in_at'] }}</td>
                    <td>{{ $login['user']['name'] ?? '' }}</td>
                    <td>{{ $login['usr_lg_ip_address'] }}</td>
                    <td>{{ $login['usr_lg_user_agent'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
