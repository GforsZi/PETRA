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
                    <h3 class="card-title">150</h3>
                    <p class="card-text">Pengguna</p>
                    <i class="fas fa-users fa-2x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
            <div class="card text-dark bg-warning">
                <div class="card-body">
                    <h3 class="card-title">53<sup style="font-size: 20px">%</sup></h3>
                    <p class="card-text">Pendatang Baru</p>
                    <i class="fas fa-chart-line fa-1x position-absolute top-0 end-0 m-3"></i>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-white bg-danger" style="height: 100%;">
                <div class="card-body">
                    <h3 class="card-title">44</h3>
                    <p class="card-text">Laporan</p>
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
                <div class="book text-center ">
                    <a href="/search/book/{{ $bk_nw->bk_id }}/detail"
                        style="text-decoration: none;">
                        <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/uni_invt.png') }}"
                            class="object-fit-cover" style="height: 160px;">
                        <br>
                        <p class="text-body">{{ $bk_nw->bk_title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-4">
        <h6>Buku Terbaru</h6>
        <div class="scroll-x">
            @foreach ($book_new as $bk_nw)
                <div class="book text-center ">
                    <a href="/search/book/{{ $bk_nw->bk_id }}/detail"
                        style="text-decoration: none;">
                        <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/uni_invt.png') }}"
                            class="object-fit-cover" style="height: 160px;">
                        <br>
                        <p class="text-body">{{ $bk_nw->bk_title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
