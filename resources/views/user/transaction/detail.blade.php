<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">

        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="mb-3">Detail Peminjaman</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 30%;">Title</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ID Peminjaman</td>
                                <td>PMJ-001</td>
                            </tr>
                            <tr>
                                <td>Nama Peminjam</td>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <td>Email Peminjam</td>
                                <td>john.doe@mail.com</td>
                            </tr>
                            <tr>
                                <td>Judul Buku</td>
                                <td>Pemrograman Laravel</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pinjam</td>
                                <td>2025-09-27 12:30:00</td>
                            </tr>
                            <tr>
                                <td>Tanggal Kembali</td>
                                <td>2025-10-04 12:30:00</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="badge bg-success">Dipinjam</span></td>
                            </tr>
                            <tr>
                                <td>Dibuat Pada</td>
                                <td>2025-09-27 12:30:00</td>
                            </tr>
                            <tr>
                                <td>Diubah Pada</td>
                                <td>2025-09-27 12:45:00</td>
                            </tr>
                            <tr>
                                <td>Dihapus Pada</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
