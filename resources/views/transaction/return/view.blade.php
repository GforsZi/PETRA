<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <x-table_data :paginator="$returns">
        <x-slot:title></x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th>Tanggal Peminjaman</th>
            <th>Batas Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Peminjaman</th>
            <th style="width: 50px">option</th>
        </x-slot:header>
        @forelse ($returns as $index => $return)
            <tr class="align-middle">
                <td>{{ $returns->firstItem() + $index }}</td>
                <td>{{ $return->trx_borrow_date }}</td>
                <td>{{ $return->trx_due_date }}</td>
                <td>{{ $return->trx_due_date }}</td>
                <td>
                    @if ($return->trx_status == '1')
                        Pengajuan
                    @elseif ($return->trx_status == '2')
                        Dipinjam
                    @elseif ($return->trx_status == '3')
                        Dikembalikan
                    @else
                        Ditolak
                    @endif
                </td>
                <td>
                    <a href="/manage/transaction/{{ $return->trx_id }}/detail"
                        class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="w-100 text-center">404 | Data tidak ditemukan</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
