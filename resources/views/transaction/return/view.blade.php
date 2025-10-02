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
        <x-slot:title>Manage return</x-slot:title>
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
                        Dipinjam
                    @elseif ($return->trx_status == '2')
                        Dikembalikan
                    @endif
                </td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="/manage/return/{{ $return->bk_orgn_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="/manage/return/{{ $return->bk_orgn_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation{{ $returns->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade"
                        id="deleteConfirmation{{ $returns->firstItem() + $index }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $returns->firstItem() + $index }}Label"
                        aria-hidden="true">
                        <form action="/system/return/{{ $return->bk_orgn_id }}/delete"
                            method="post" class="modal-dialog modal-dialog-centered">
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
                <td colspan="6" class="w-100 text-center">404 | data not found</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
