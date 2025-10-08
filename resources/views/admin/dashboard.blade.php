<x-app-layout>
    <style>
        @media (max-width: 990px) {
            .hero-card-3 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $user_amount }}</h3>
                    <p>Pengguna Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_book }}</h3>
                    <p>Total Buku</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 hero-card-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $total_transaction }}</h3>
                    <p>Total Transaksi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Row Chart -->
    <div class="row">
        <div class="col-md-8">
            <canvas id="loginChart" height="120"></canvas>
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Ringkasan</h5>
                    <p>Periode: {{ $days }} hari terakhir</p>
                    <p>Total Login: <strong>{{ array_sum($data) }}</strong></p>
                    <p>Rata-rata per hari:
                        <strong>{{ round(array_sum($data) / max(1, count($data)), 2) }}</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <canvas id="doughnutChart" style="height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function() {
            const labels = {!! json_encode($labels) !!}; // ['09 Sep', '10 Sep', ...]
            const data = {!! json_encode($data) !!}; // [12, 5, 0, ...]

            const ctx = document.getElementById('loginChart').getContext('2d');

            const loginChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Login per Hari',
                        data: data,
                        borderWidth: 1,
                        // Jangan set warna agar sesuai permintaan awal (Chart.js default colors)
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: false,
                            }
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
        })();
        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Doughnut Chart
        new Chart(document.getElementById('doughnutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Yellow', 'Blue'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                        'rgb(54, 162, 235)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
</x-app-layout>
