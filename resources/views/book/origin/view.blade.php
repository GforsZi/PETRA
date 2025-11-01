<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/manage/origin/add" class="btn btn-lg btn-outline-primary w-100" title="Tambah Asal Pemberi buku"><i class="bi bi-book-half"></i></a>
    </x-slot:header_layout>
    <x-table_data :paginator="$origins">
        <x-slot:title>
            <form class="d-flex" role="search" method="get" action="/manage/origin">
                <input class="form-control me-2" name="s" value="{{ request('s') }}" type="search" placeholder="Masukan Nama Pemberi" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">No</th>
            <th>Sumber</th>
            <th style="width: 50px"></th>
        </x-slot:header>
        @forelse ($origins as $index => $origin)
            <tr class="align-middle">
                <td>{{ $origins->firstItem() + $index }}</td>
                <td><a href="/manage/book?origin={{ $origin->bk_orgn_id }}" class="text-body text-decoration-none">{{ $origin->bk_orgn_name }}</a></td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/manage/origin/{{ $origin->bk_orgn_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item" href="/manage/origin/{{ $origin->bk_orgn_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $origins->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade" id="deleteConfirmation{{ $origins->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $origins->firstItem() + $index }}Label" aria-hidden="true">
                        <form action="/system/origin/{{ $origin->bk_orgn_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
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
                                        Penghapusan ini bersifat <strong>tidak permanen
                                            </strong> — data masih dapat
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
        <style>
a.text-body.text-decoration-none {
  position: relative;
  text-decoration: none !important;
}

a.text-body.text-decoration-none::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 0;
  width: 0;
  height: 2px; /* garis tipis */
  background-color: currentColor;
  transition: all 0.3s ease-in-out;
  transform: translateX(-50%);
}

a.text-body.text-decoration-none:hover::after {
  width: 100%;
}




    </style>
</x-app-layout>
