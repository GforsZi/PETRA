<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <style>
        .book img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .scroll-x {
            overflow-x: auto;
            white-space: nowrap;
        }

        .scroll-x .book {
            display: inline-block;
            width: 120px;
            margin-right: 10px;
        }
    </style>

    <div class="row g-3">
        <div class="col-8">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h3 class="card-title me-2">Status:</h3>
                    <p class="card-text">
                        @if (Auth::user()->usr_activation == true)
                            Sudah teraktifasi
                        @else
                            Belum teraktifasi
                        @endif
                    </p>
                    <i class="fas fa-users fa-2x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
            <div class="card text-dark bg-warning">
                <div class="card-body">
                    <h3 class="card-title me-2">Peran:</h3>
                    <p class="card-text">{{ Auth::user()->roles?->rl_name ?? 'Tidak ada' }}</p>
                    <i class="fas fa-chart-line fa-1x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-white bg-danger" style="height: 100%;">
                <div class="card-body">
                    <canvas id="doughnutChart" style="height:100px;"></canvas>
                    <i
                        class="fas fa-exclamation-triangle fa-2x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h6>Buku Terpopuler</h6>
        <div class="scroll-x">
            @foreach ($book_new as $bk_nw)
                <div class="book text-center border rounded pt-2" style="width: 140px;">
                    <a href="/search/book/{{ $bk_nw->bk_id }}/detail"
                        style="text-decoration: none;">
                        <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/book_placeholder.jpg') }}"
                            class="object-fit-contain" style="height: 167px; width: 128px;">
                       <p class="text-body text-start text-wrap mt-1 mb-0"
    title="{{ $bk_nw->bk_title }}"
    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
           overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
           -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
    {{ $bk_nw->bk_title }}
</p>

                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4">
        <h6>Buku Terbaru</h6>
        <div class="scroll-x">
            @foreach ($book_new as $bk_nw)
                <div class="book text-center border rounded pt-2" style="width: 140px;">
                    <a href="/search/book/{{ $bk_nw->bk_id }}/detail"
                        style="text-decoration: none;">
                        <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/book_placeholder.jpg') }}"
                            class="object-fit-contain" style="height: 167px; width: 128px;">
                        <br>
                      <p class="text-body text-start text-wrap mt-1 mb-0"
    title="{{ $bk_nw->bk_title }}"
    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
           overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
           -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
    {{ $bk_nw->bk_title }}
</p>

                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Doughnut Chart
        const ctx = document.getElementById('doughnutChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: [
                        {{ $chartData['proses'] }},
                        {{ $chartData['diterima'] }},
                        {{ $chartData['ditolak'] }}
                    ],
                    backgroundColor: [
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 99, 132)'
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
