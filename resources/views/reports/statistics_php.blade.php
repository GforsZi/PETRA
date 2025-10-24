<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Report Login {{ $start }} - {{ $end }}</title>
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

<body>
    <div class="report-header">
        <h4>Statistik Login User</h4>
        <div>{{ $start }} — {{ $end }}</div>
    </div>

    <div class="chart-wrapper">
        <canvas id="loginChart" width="1000" height="300"></canvas>
    </div>

    <h5>Data Per-hari</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:40%;">Tanggal</th>
                <th style="width:20%; text-align:right;">Jumlah Login</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($table as $row)
                <tr>
                    <td>{{ $row['label'] }}</td>
                    <td style="text-align:right;">{{ $row['count'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const labels = {!! json_encode($labels) !!};
            const data = {!! json_encode($data) !!};
            const ctx = document.getElementById('loginChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Login per Hari',
                        data: data,
                        borderWidth: 1,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            display: true
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // beri tanda pada window agar Browsershot menunggu sampai chart selesai
            window.chartReady = true;
        })();
    </script>
</body>

</html>
