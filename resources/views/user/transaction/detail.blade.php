<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
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
                                <td>{{ $transaction['trx_id'] }}</td>
                            </tr>
                            <tr>
                                <td>Nama Peminjam</td>
                                <td>{{ $transaction['users']['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Peminjam</td>
                                <td>{{ $transaction['users']['usr_no_wa'] }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan pinjaman</td>
                                <td>
                                    @if ($transaction['trx_title'] == '1')
                                        Kegiatan Belajar Mengajar
                                    @else
                                        Peribadi
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan Pinjam</td>
                                <td>{{ $transaction['trx_borrow_date'] }}</td>
                            </tr>
                            <tr>
                                <td>Tenggat Pengembalian</td>
                                <td>{{ $transaction['trx_due_date'] }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if ($transaction['trx_status'] == '1')
                                        <span class="badge bg-warning">Pengajuan</span>
                                    @elseif ($transaction['trx_status'] == '2')
                                        <span class="badge bg-info">Dipinjam</span>
                                    @elseif ($transaction['trx_status'] == '3')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
