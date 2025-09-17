<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
<div class="row">
    <div class="col-lg-4 col-6">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>150</h3>
          <p>Users</p>
        </div>
        <div class="icon">
          <i class="fas fa-users"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>
          <p>Growth</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-line"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>44</h3>
          <p>Errors</p>
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
