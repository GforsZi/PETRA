<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-4 ">
        <div class="card-header">
            <h3 class="card-title">Detail option</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>value</th>
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
                    <tr>
                        <td>Dibuat oleh</td>
                        <td>{{ $transaction['created_by']['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Diubah oleh</td>
                        <td>{{ $transaction['updated_by']['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Dihapus oleh</td>
                        <td>{{ $transaction['deleted_by']['name'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat Pada</td>
                        <td>{{ $transaction['trx_created_at'] }}</td>
                    </tr>
                    <tr>
                        <td>Diubah pada</td>
                        <td>{{ $transaction['trx_updated_at'] }}</td>
                    </tr>
                    <tr>
                        <td>Dihapus pada</td>
                        <td>{{ $transaction['trx_deleted_at'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex m-2 gap-2">
            @if ($transaction['trx_deleted_at'] == null)
                <a class="btn btn-lg btn-danger"style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation{{ $transaction['trx_id'] }}"
                    title="Hapus Transaksi"><i class="bi bi-trash"></i></a>
            @endif
            @if ($transaction['trx_status'] == '1' ?? $transaction['trx_due_date'] == null)
                <a class="btn btn-lg btn-warning" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#rejectconfirmation{{ $transaction['trx_id'] }}"
                    title="Tolak Transaksi"><i class="bi bi-ban"></i></a>
                <a class="btn btn-lg btn-success" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#approveconfirmation{{ $transaction['trx_id'] }}"
                    title="Terima Transaksi"><i class="bi bi-check2-all"></i></a>
            @endif

        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Loan asset</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 20%">ID</th>
                        <th>Judul</th>
                        <th>Salinan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaction['books'] as $book)
                        <tr class="align-middle">
                            <td>{{ $book->bk_id }}</td>
                            <td>{{ $book->bk_title }}</td>
                            <td>
                                @php
                                    $copies = collect($transaction['book_copies'])->where(
                                        'bk_cp_book_id',
                                        $book->bk_id,
                                    );
                                @endphp

                                @forelse ($copies as $copy)
                                    <span
                                        class="badge bg-secondary">{{ $copy->bk_cp_number }}</span>
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
        <!-- /.card-body -->
    </div>
    <div class="modal fade" id="approveconfirmation{{ $transaction['trx_id'] }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="approveconfirmation{{ $transaction['trx_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered"
            action="/system/transaction/{{ $transaction['trx_id'] }}/approve">
            @csrf
            @method('PUT')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Konfirmasi Pinjaman</h5>
                </div>
                <div class="mb-3 container">
                    <label for="datetime" class="form-label">Pilih Tanggal & Waktu, untuk tenggat
                        pengembalian</label>
                    <input type="datetime-local" name='datetime'
                        class="form-control @error('datetime') is-invalid @enderror" id="datetime"
                        name="datetime" {{ old(\Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" onclick="this.disabled=true; this.form.submit();"><strong>Terima</strong></button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="rejectconfirmation{{ $transaction['trx_id'] }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="rejectconfirmation{{ $transaction['trx_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered"
            action="/system/transaction/{{ $transaction['trx_id'] }}/reject">
            @csrf
            @method('PUT')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Konfirmasi</h5>
                    <p class="mb-0">Yakin ingin menolak pinjaman ini ?</p>
                </div>
                @foreach ($transaction['books'] as $book)
                    <input type="hidden" name="all_book_ids[]" value="{{ $book->bk_id }}">
                @endforeach
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Tidak</button>
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Ya</strong></button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="deleteConfirmation{{ $transaction['trx_id'] }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteConfirmation{{ $transaction['trx_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered"
            action="/system/transaction/{{ $transaction['trx_id'] }}/delete">
            @csrf
            @method('DELETE')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Konfirmasi</h5>
                    <p class="mb-0">Yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Tidak</button>
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Ya</strong></button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
