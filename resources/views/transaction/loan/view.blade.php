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
        <x-slot:title></x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th>Peminjam</th>
            <th>Tanggal pengajuan</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th>Tenggak waktu</th>
            <th style="width: 50px">option</th>
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
                    @else
                        Ditolak
                    @endif
                </td>
                <td>{{ $loan->trx_due_date }}</td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="/manage/transaction/{{ $loan->trx_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="/manage/loan/{{ $loan->trx_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation{{ $loans->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade"
                        id="deleteConfirmation{{ $loans->firstItem() + $index }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $loans->firstItem() + $index }}Label"
                        aria-hidden="true">
                        <form action="/system/loan/{{ $loan->trx_id }}/delete" method="post"
                            class="modal-dialog modal-dialog-centered">
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
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit"
                                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Hapus</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="w-100 text-center">404 | Data tidak ditemukan</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
