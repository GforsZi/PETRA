<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row g-3">
        <div class="col-md-8 d-flex flex-column">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h3 class="card-title">150</h3>
                    <p class="card-text">Users</p>
                    <i class="fas fa-users fa-2x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
            <div class="card text-dark bg-warning">
                <div class="card-body">
                    <h3 class="card-title">53<sup style="font-size: 20px">%</sup></h3>
                    <p class="card-text">Growth</p>
                    <i class="fas fa-chart-line fa-1x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger" style="height: 93%;">
                <div class="card-body">
                    <h3 class="card-title">44</h3>
                    <p class="card-text">Errors</p>
                    <i
                        class="fas fa-exclamation-triangle fa-2x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-4 g-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <canvas id="barChart" style="height:300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="doughnutChart" style="height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <a href="dashboard.html" class="btn btn-outline-warning">Dashboard</a>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
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
