<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header_layout>
        <a href="/manage/book/major/add" class="btn btn-outline-primary w-100">Tambah Jurusan
            Baru</a>
    </x-slot:header_layout>
    <x-table_data :paginator="$majors">
        <x-slot:title>Manage Major</x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th>Tingkatan</th>
            <th>Jurusan</th>
            <th style="width: 50px">option</th>
        </x-slot:header>
        @forelse ($majors as $index => $major)
            <tr class="align-middle">
                <td>{{ $majors->firstItem() + $index }}</td>
                <td>{{ $major->bk_mjr_class }}</td>
                <td>{{ $major->bk_mjr_major }}</td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="/manage/book/major/{{ $major->bk_mjr_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="/manage/book/major/{{ $major->bk_mjr_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation{{ $majors->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade"
                        id="deleteConfirmation{{ $majors->firstItem() + $index }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $majors->firstItem() + $index }}Label"
                        aria-hidden="true">
                        <form action="/system/major/{{ $major->bk_mjr_id }}/delete" method="post"
                            class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin menghapus data ini?
                                        {{ $majors->firstItem() + $index }}.</p>
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
                <td colspan="4" class="w-100 text-center">404 | data not found</td>
            </tr>
        @endforelse
    </x-table_data>
</x-app-layout>
