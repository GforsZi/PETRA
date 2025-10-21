<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <x-table_data :paginator="$loans">
        <x-slot:title>
            <form class="d-flex" role="search" method="get" action="/manage/loan">
                <input class="form-control me-2" name="s" type="search"
                    placeholder="Masukan Nama Peminjam" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit"><i
                        class="bi bi-search"></i></button>
            </form>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th>Peminjam</th>
            <th>Tanggal pengajuan</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th>Tenggat peminjaman</th>
            <th style="width: 50px">Detail</th>
        </x-slot:header>
        @forelse ($loans as $index => $loan)
            <tr class="align-middle">
                <td>{{ $loans->firstItem() + $index }}</td>
                <td>{{ $loan->users->name }}</td>
                <td>{{ $loan->trx_borrow_date }}</td>
                <td>
                    @if ($loan->trx_title == '1')
                        Kegiatan Belajar Mengajar
                    @elseif ($loan->trx_title == '2')
                        Pribadi
                    @endif
                </td>
                <td>
                    @if ($loan->trx_status == '1')
                        Pengajuan
                    @elseif ($loan->trx_status == '2')
                        Dipinjam
                    @elseif ($loan->trx_status == '3')
                        Dikembalikan
                    @else
                        Ditolak
                    @endif
                </td>
                @php
                    $dueDate = $loan->trx_due_date
                        ? \Carbon\Carbon::parse($loan->trx_due_date)
                        : null;
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
                    <a href="/manage/transaction/{{ $loan->trx_id }}/detail"
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
