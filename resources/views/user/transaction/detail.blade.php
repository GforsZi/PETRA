<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="w-100" style="max-width: 400px; height: 100vh;">

        <h5 class="fw-bold mb-4 text-center">Detail Peminjaman Buku</h5>

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Nama Buku</h6>
                <p class="card-text">Belajar Laravel untuk Pemula</p>

                <h6 class="card-subtitle mb-2 text-muted">Nama Peminjam</h6>
                <p class="card-text">Nabil</p>

                <h6 class="card-subtitle mb-2 text-muted">Tanggal Pinjam</h6>
                <p class="card-text">27 September 2025</p>

                <h6 class="card-subtitle mb-2 text-muted">Tanggal Kembali</h6>
                <p class="card-text">4 Oktober 2025</p>

                <h6 class="card-subtitle mb-2 text-muted">Status</h6>
                <span class="badge bg-success">Dipinjam</span>
            </div>
        </div>
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h4>Deskripsi</h4>
                <p class="card-text">First time cooking bubur. I hope my cooking gets much better in the future. I learned to make this because I want to treat my sick loved ones with my food. And especially because of her—I want to cook this for her later. I hope you get well soon, my brave one, my beautiful one, one of the best women I know 💙.</p>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <a href="{{ url('/pinjam') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
</x-app-layout>
