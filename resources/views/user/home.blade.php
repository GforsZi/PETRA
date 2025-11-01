<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

        .book {
            /* box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 10px;
        }

        .book:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
        }

        .row.g-3 {
            align-items: stretch;
        }

        .row.g-3>[class*="col-"] {
            display: flex;
            flex-direction: column;
        }

        .row.g-3>[class*="col-"] .card {
            flex: 1 1 auto;
        }

        /* Chart stabil & proporsional */
        .chart-container {
            width: 100%;
            height: 130px;
        }

        #doughnutChart {
            width: 100% !important;
            height: 100% !important;
        }

        @media (max-width: 345px) {

            /* jika lebar layar kecil (biasanya mulai bertabrakan) */
            .card-body.px-4.py-4.d-flex.align-items-center.justify-content-between.position-relative {
                flex-wrap: wrap;
                /* izinkan teks turun jika tidak cukup ruang */
                text-align: center;
            }

            .card-body .card-text {
                flex: 1 1 100%;
                text-align: center;
                margin-bottom: 10px !important;
            }

            .card-body>div[style*="position: absolute"] {
                position: static !important;
                transform: none !important;
                right: auto !important;
                top: auto !important;
            }
        }

        body {
            background-color: #fff;
            color: #333;
        }

        .custom-card {
            background-color: color-mix(in srgb, var(--bs-body-bg, #fff) 90%, #000 10%);
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        @media (prefers-color-scheme: dark) {
            .custom-card {
                background-color: color-mix(in srgb, var(--bs-body-bg, #121212) 85%, #fff 10%);
            }
        }
    </style>

    <div class="row g-3 align-items-stretch">
        <div class="col-8">
            <div class="row g-3">
                <!-- STATUS -->
                <div class="col-md-6 d-flex">
                    <div class="card text-white border-0 shadow-sm rounded-4 overflow-hidden flex-fill" style="background: #198754; position: relative; min-height: 100px;">
                        <div>
                            <h3 class="text-white text-center fw-bold mb-0">Total peminjaman</h3>
                        </div>

                        <div class="card-body px-4 py-4 d-flex align-items-center justify-content-between position-relative">
                            <p class="card-text fs-5 mb-0 fw-semibold">
                                {{ $loan . ' transaksi' }}
                            </p>

                            <div style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%);">
                                <script src="https://animatedicons.co/scripts/embed-animated-icons.js"></script>
                                <animated-icons src="https://animatedicons.co/get-icon?name=Success&style=minimalistic&token=2cb0da6b-0dad-4d02-8599-79b76c0333fb" trigger="loop"
                                    attributes='{"defaultColours":{"group-1":"#14F652FF","background":"#0BB125FF"}}' height="55" width="55">
                                </animated-icons>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PERAN -->
                <div class="col-md-6 d-flex">
                    <div class="card text-dark border-0 shadow-sm rounded-4 overflow-hidden flex-fill"
                        style="background: linear-gradient(135deg, #ffe082 0%, #ffca28 100%); position: relative; min-height: 100px;">
                        <div>
                            <h3 class="text-white text-center fw-bold mb-0">Peran</h3>
                        </div>

                        <div class="card-body px-4 py-4 d-flex align-items-center justify-content-between position-relative">
                            <p class="card-text fs-5 mb-0 fw-semibold text-light">
                                {{ Auth::user()->roles?->rl_name ?? 'Tidak ada' }}
                            </p>

                            <div style="position: absolute; top: 50%; right: 20px; transform: translateY(-50%);">
                                <script src="https://animatedicons.co/scripts/embed-animated-icons.js"></script>
                                <animated-icons src="https://animatedicons.co/get-icon?name=Individual&style=minimalistic&token=ae97ee7c-56cc-4490-90bd-ecd3fc81466e" trigger="loop"
                                    attributes='{"defaultColours":{"group-1":"#000000","background":"#FFE19AFF"}}' height="55" width="55">
                                </animated-icons>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DATA DIAGRAM -->
        <div class="col-4 d-flex">
            <div class="card text-white bg-danger border-0 shadow-sm rounded-4 overflow-hidden flex-fill" style="position: relative; min-height: 100px;">
                <div class="card-body position-relative d-flex align-items-center justify-content-center p-4">
                    <div class="chart-container" style="width: 100%; height: 70px; position: relative;">
                        <canvas id="doughnutChart"></canvas>
                    </div>
                    <i class="fas fa-exclamation-triangle fa-2x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h6>Buku Terpopuler</h6>
        <div class="scroll-x">
            @foreach ($book_loan as $bk_ln)
                <div class="custom-card book text-center border rounded pt-2"
                    style="width: 140px; height: 230px; display: inline-flex; flex-direction: column; justify-content: space-between; vertical-align: top; margin-right: 8px;">

                    <a href="/search/book/{{ $bk_ln->bk_id }}/detail" style="text-decoration: none;">
                        <img src="{{ asset($bk_ln->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                    </a>

                    <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $bk_ln->bk_title }}"
                        style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                           overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                           -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;
                           min-height: 38px;">
                        {{ $bk_ln->bk_title }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <h5>buku terbaru</h5>
        <div class="scroll-x">
            @foreach ($book_new as $bk_nw)
                <div class="custom-card book text-center border rounded pt-2"
                    style="width: 140px; height: 230px; display: inline-flex; flex-direction: column; justify-content: space-between; vertical-align: top; margin-right: 8px;">

                    <a href="/search/book/{{ $bk_nw->bk_id }}/detail" style="text-decoration: none;">
                        <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                        <br>
                        <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $bk_nw->bk_title }}"
                            style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                               overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                               -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;
                               min-height: 38px;">
                            {{ $bk_nw->bk_title }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('doughnutChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: [
                        {{ $chartData['proses'] }},
                        {{ $chartData['diterima'] }},
                        {{ $chartData['dikembalikan'] }},
                        {{ $chartData['ditolak'] }}
                    ],
                    backgroundColor: [
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(120, 200, 65)',
                        'rgb(255, 99, 132)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                return context[0].dataset.label.replace(' ', '\n');
                            },
                            label: function(context) {
                                return context.formattedValue;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
