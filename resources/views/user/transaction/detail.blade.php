<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">

        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="mb-3 text-center">Detail Peminjaman</h5>

                <div class="table-responsive border rounded">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Keterangan</th>
                                <th>Isi</th>
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
                                @php
                                    $dueDate = $transaction->trx_due_date ? \Carbon\Carbon::parse($transaction->trx_due_date) : null;
                                @endphp

                                <td
                                    class="
                        @if (is_null($dueDate)) text-muted
                        @elseif (now()->greaterThan($dueDate))
                            text-danger
                        @else
                            text-warning @endif
                    ">
                                    {{ $dueDate ? $dueDate->format('Y-m-d H:i') : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengembalian</td>
                                <td>{{ $transaction['trx_return_date'] }}</td>
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
                <div class="table-responsive my-4 border rounded">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 20%">ID</th>
                                <th>Judul</th>
                                <th>Salinan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                                <tr class="align-middle">
                                    <td>{{ $book->bk_id }}</td>
                                    <td>{{ $book->bk_title }}</td>
                                    <td>
                                        @php
                                            $copies = $copiesGrouped[$book->bk_id] ?? collect();
                                        @endphp

                                        @forelse ($copies as $copy)
                                            <span class="badge bg-secondary">{{ $copy->bk_cp_number }}</span>
                                        @empty
                                            <span class="text-muted">Seluruh salinan</span>
                                        @endforelse
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">404 | Data tidak ditemukan</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
