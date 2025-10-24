<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-table_data :paginator="$transactions">
        <x-slot:title>
            <form class="d-flex" role="search" method="get" action="/manage/transaction">
                <input class="form-control me-2" name="s" type="search" placeholder="Masukan Nama Peminjam" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th>Peminjam</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th>Tanggal Peminjaman</th>
            <th>Tenggat Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th style="width: 50px">Detail</th>
        </x-slot:header>
        @forelse ($transactions as $index => $transaction)
            <tr class="align-middle">
                <td>{{ $transactions->firstItem() + $index }}</td>
                <td>{{ $transaction->users->name ?? '' }}</td>
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
                <td>{{ $transaction->trx_borrow_date ?? '' }}</td>
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

                <td>{{ $transaction->trx_return_date ?? '' }}</td>
                <td>
                    <a href="/manage/transaction/{{ $transaction->trx_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="w-100 text-center">404 | Data tidak ditemukan</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
