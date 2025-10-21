<x-app-layout>
    <x-slot:title>Export Statistik Login</x-slot:title>
    <div class="mt-2">
        <div class="card shadow-sm">
            <div class="card-body">

                <form method="GET" action="/manage/export/statistics" class="row g-2 mb-4">
                    <div class="col-auto">
                        <label>Start</label>
                        <input type="date" name="start" class="form-control"
                            value="{{ $start }}">
                    </div>
                    <div class="col-auto">
                        <label>End</label>
                        <input type="date" name="end" class="form-control"
                            value="{{ $end }}">
                    </div>
                    <div class="col-auto align-self-end">
                        <button class="btn btn-primary">Filter</button>
                    </div>

                    <div class="w-100 d-flex justify-content-end">
                        <a href="{{ route('statistics.export', ['start' => $start, 'end' => $end]) }}"
                            class="btn btn-outline-success"><i class="bi bi-file-earmark-excel"></i>
                            Export PDF</a>
                    </div>
                </form>

                <div class="card mb-4">
                    <div class="card-body">
                        <canvas id="loginChart" height="120"></canvas>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Data Per-hari</div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th class="text-end">Jumlah Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table as $row)
                                    <tr>
                                        <td>{{ $row['label'] }}</td>
                                        <td class="text-end">{{ $row['count'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const labels = {!! json_encode($labels) !!};
            const data = {!! json_encode($data) !!};
            const ctx = document.getElementById('loginChart').getContext('2d');

            const loginChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Login per Hari',
                        data: data,
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Login'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' login';
                                }
                            }
                        }
                    }
                }
            });

            // beri tanda bahwa chart sudah render (Browsershot akan menunggu ini)
            window.chartReady = true;
        })();
    </script>
</x-app-layout>
