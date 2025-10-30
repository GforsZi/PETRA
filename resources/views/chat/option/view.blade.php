<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/manage/chat/option/add" class="btn btn-outline-primary btn-lg w-100" title="Tambahkan Opsi"><i class="bi bi-plus-lg"></i></a>
    </x-slot:header_layout>
    <x-table_data :paginator="$options">
        <x-slot:title>
            <form class="d-flex" role="search" method="get" action="/manage/chat/option">
                <input class="form-control me-2" name="s" value="{{ request('s') }}" type="search" placeholder="Masukan Judul Opsi" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">No</th>
            <th>Judul</th>
            <th>Tipe</th>
            <th style="width: 50px"></th>
        </x-slot:header>
        @forelse ($options as $index => $option)
            <tr class="align-middle">
                <td>{{ $options->firstItem() + $index }}</td>
                <td>{{ $option->cht_opt_title }}</td>
                <td>
                    @if ($option->cht_opt_type == '1')
                        Pemberitahuan aktifasi
                    @elseif ($option->cht_opt_type == '2')
                        Peringatan waktu peminjaman
                    @else
                        Pesan bantuan
                    @endif
                </td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="/manage/chat/option/{{ $option->cht_opt_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item" href="/manage/chat/option/{{ $option->cht_opt_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $options->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade" id="deleteConfirmation{{ $options->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $options->firstItem() + $index }}Label" aria-hidden="true">
                        <form action="/system/option/{{ $option->cht_opt_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin menghapus data ini ?</p>
                                </div>
                                <div class="alert mx-4 mt-4 alert-warning d-flex text-start align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <div class="text-wrap">
                                        Penghapusan ini bersifat <strong>soft
                                            delete</strong> — data masih dapat
                                        dipulihkan dari halaman riwayat.
                                    </div>
                                </div>
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                                        onclick="this.disabled=true; this.form.submit();"><strong>Hapus</strong></button>
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
