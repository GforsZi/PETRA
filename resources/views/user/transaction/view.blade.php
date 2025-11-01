<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/transaction/add" class="btn btn-lg btn-outline-primary" title="Tambah Transaksi"><i class="bi bi-plus-lg"></i></a>
        <a href="/transaction?expired=true" class="btn btn-lg btn-outline-warning" title="Tenggat pengembalian"><i class="bi bi-exclamation-triangle"></i></a>
    </x-slot:header_layout>
    <x-table_data :paginator="$transactions">
        <x-slot:title>Managemen Transaksi</x-slot:title>
        <x-slot:header>
            <th style="width: 10px">No</th>
            <th>Tanggal Pengajuan</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th>Tenggat Pengembalian</th>
            <th style="width: 50px"></th>
        </x-slot:header>
        @forelse ($transactions as $index => $transaction)
            <tr class="align-middle">
                <td>{{ $transactions->firstItem() + $index }}</td>
                <td>{{ $transaction->trx_borrow_date }}</td>
                <td>
                    @if ($transaction->trx_title == '1')
                        Kegiatan Belajar Mengajar
                    @elseif ($transaction->trx_title == '2')
                        Pribadi
                    @endif
                </td>
                <td>
                    @if ($transaction->trx_status == '1')
                        Pengajuan
                    @elseif ($transaction->trx_status == '2')
                        Dipinjam
                    @elseif ($transaction->trx_status == '3')
                        Dikembalikan
                    @else
                        Ditolak
                    @endif
                </td>
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
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="/transaction/{{ $transaction->trx_id }}/detail">Detail</a>
                            </li>
                            @if ($transaction->trx_status == '1')
                                <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $transactions->firstItem() + $index }}">Batalkan</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="modal fade" id="deleteConfirmation{{ $transactions->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $transactions->firstItem() + $index }}Label" aria-hidden="true">
                        <form action="/system/transaction/{{ $transaction->trx_id }}/cancle" method="post" class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('PUT')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin membatalkan pinjaman ini?</p>
                                </div>
                                @foreach ($transaction->books as $book)
                                    <input type="hidden" name="all_book_ids[]" value="{{ $book->bk_id }}">
                                @endforeach
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                                        onclick="this.disabled=true; this.form.submit();"><strong>Ya</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="w-100 text-center">404 | Data Tidak D itemukan</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
