<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">

        <div class="card shadow-sm text-dark p-4 rounded-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-center mb-3 mb-md-0">
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                         alt="Foto Profil"
                         class="rounded-circle"
                         style="width: 120px; height: 120px; object-fit: cover;">
                </div>

                <div class="col-12 col-md-7">
                    <p><strong>Nama :</strong> John Doe</p>
                    <p><strong>Email :</strong> john.doe@mail.com</p>
                    <p><strong>Peran :</strong> Admin</p>
                    <p><strong>Status :</strong> Aktif</p>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-center gap-3 mt-4 d-md-none">
            <button class="btn btn-outline-dark">Lihat daftar pinjaman</button>
            <button class="btn btn-outline-dark">Lihat riwayat pinjaman</button>
        </div>
    </div>
</x-app-layout>
