<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-table_data :paginator="$submissons">
        <x-slot:title>
            <form class="d-flex" role="search" method="get" action="/manage/submission">
                <input class="form-control me-2" name="s" type="search" placeholder="Masukan Nama Peminjam" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">No</th>
            <th>Peminjam</th>
            <th>Tanggal pengajuan</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th style="width: 50px"></th>
        </x-slot:header>
        @forelse ($submissons as $index => $submission)
            <tr class="align-middle">
                <td>{{ $submissons->firstItem() + $index }}</td>
                <td>{{ $submission->users->name ?? '' }}</td>
                <td>{{ $submission->trx_borrow_date ?? '' }}</td>
                <td>
                    @if ($submission->trx_title == '1')
                        Kegiatan Belajar Mengajar
                    @elseif ($submission->trx_title == '2')
                        Pribadi
                    @endif
                </td>
                <td>
                    @if ($submission->trx_status == '1')
                        Pengajuan
                    @elseif ($submission->trx_status == '2')
                        Dipinjam
                    @elseif ($submission->trx_status == '3')
                        Dikembalikan
                    @else
                        Ditolak
                    @endif
                </td>
                <td>
                    <a href="/manage/transaction/{{ $submission->trx_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="w-100 text-center">404 | Data tidak ditemukan</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
