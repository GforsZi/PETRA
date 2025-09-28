<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="row g-0 ">
        <div class="col-12 col-md-4 d-flex justify-content-center p-3">
            <img src="{{ asset($book['bk_img_url'] ?? '/logo/uni_invt.png') }}"
                class="card-img-top object-fit-contain cover" alt="" height="300">
        </div>
        <div class="card mb-4 col-12 col-md-8">
            <div class="card-header">
                <h3 class="card-title">Detail book</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>Judul</td>
                            <td>{{ $book['bk_title'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>ISBN</td>
                            <td>{{ $book['bk_isbn'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>deskripsi</td>
                            <td>{{ $book['bk_description'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Tahun terbit</td>
                            <td>{{ $book['bk_published_year'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Jenis</td>
                            <td>
                                @if ($book['bk_type'] == '1')
                                    Buku Fisik
                                @else
                                    Buku Digital
                                @endif
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td>Klasifikasi</td>
                            <td>
                                @foreach ($book['deweyDecimalClassfications'] as $ddc)
                                    <span class="badge text-bg-warning">{{ $ddc->ddc_code }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td>Penulis</td>
                            <td>
                                @foreach ($book['authors'] as $author)
                                    <span
                                        class="badge text-bg-primary">{{ $author->athr_name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td>Penerbit</td>
                            <td>
                                {{ $book['publisher']['pub_name'] ?? '' }}
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td>Edisi</td>
                            <td>
                                {{ $book['bk_edition_volume'] ?? '' }}
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dibuat oleh</td>
                            <td>{{ $book['created_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Diubah oleh</td>
                            <td>{{ $book['updated_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dihapus oleh</td>
                            <td>{{ $book['deleted_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dibuat Pada</td>
                            <td>{{ $book['bk_created_at'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Diubah pada</td>
                            <td>{{ $book['bk_updated_at'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dihapus pada</td>
                            <td>{{ $book['bk_deleted_at'] ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
            <div class="d-flex m-2 gap-2">
                <a class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addCopy{{ $book['bk_id'] }}" aria-expanded="false"
                    aria-controls="desc_ast">Tambah Salinan Buku</a>
                @if ($book['bk_type'] == '2')
                    <a class="btn btn-success"
                        href="{{ asset($book['bk_file_url'] ?? 'logo/uni-invt.jpg') }}">Lihat
                        ebook</a>
                @endif
                <a class="btn btn-danger"style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation{{ $book['bk_id'] }}">Hapus Buku</a>

            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Salinan Buku</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0" id="bk_cp">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 20%">ID salinan</th>
                        <th>Status</th>
                        <th style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($book['bookCopies'] as $bk_cp)
                        <tr class="align-middle" id="bk_cp_{{ $bk_cp->bk_cp_id }}">
                            <td>{{ $bk_cp->bk_cp_number }}</td>
                            <td>
                                @if ($bk_cp->bk_cp_status == '1')
                                    Tersedia
                                @elseif ($bk_cp->bk_cp_status == '2')
                                    Dipinjam
                                @elseif ($bk_cp->bk_cp_status == '3')
                                    Hilang
                                @else
                                    Rusak
                                @endif
                            </td>
                            <td>
                                <div class="dropdown dropstart">
                                    <button class="btn btn-warning dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-menu-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" style="cursor: pointer;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#changeStatus{{ $bk_cp->bk_cp_id }}">Ubah
                                                Status</a>
                                        </li>
                                        <li><a class="dropdown-item" style="cursor: pointer;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteConfirmation{{ $bk_cp->bk_cp_id }}">Hapus</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal fade"
                                    id="deleteConfirmation{{ $bk_cp->bk_cp_id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1"
                                    aria-labelledby="deleteConfirmation{{ $bk_cp->bk_cp_id }}Label"
                                    aria-hidden="true">
                                    <form action="/system/book/copy/{{ $bk_cp->bk_cp_id }}/delete"
                                        method="post" class="modal-dialog modal-dialog-centered">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content rounded-3 shadow">
                                            <div class="modal-body p-4 text-center">
                                                <h5 class="mb-0">Konfirmasi</h5>
                                                <p class="mb-0">Yakin ingin menghapus data ini?
                                                    {{ $bk_cp->bk_cp_id . $bk_cp->bk_cp_id . $bk_cp->bk_cp_id . $bk_cp->bk_cp_id }}.
                                                </p>
                                                <input type="hidden" value="{{ $book['bk_id'] }}"
                                                    name="book_id" />
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
                                <div class="modal fade" id="changeStatus{{ $bk_cp->bk_cp_id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1"
                                    aria-labelledby="changeStatus{{ $bk_cp->bk_cp_id }}Label"
                                    aria-hidden="true">
                                    <form action="/system/book/copy/{{ $bk_cp->bk_cp_id }}/edit"
                                        method="post" class="modal-dialog modal-dialog-centered">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content rounded-3 shadow">
                                            <div class="modal-body p-4 text-center">
                                                <h5 class="mb-3">Ubah Status</h5>
                                                <input type="hidden"
                                                    value="{{ $book['bk_id'] }}" name="book_id">
                                                <select name="bk_cp_status"
                                                    class="form-select @error('bk_cp_status') is-invalid @enderror"
                                                    required aria-label="Default select example">
                                                    <option value="1">Tersedia
                                                    </option>
                                                    <option value="2">Dipinjam</option>
                                                    <option value="3">Hilang</option>
                                                    <option value="4">Rusak</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer flex-nowrap p-0">
                                                <button type="button"
                                                    class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit"
                                                    class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Ubah</strong></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="w-100 text-center">404 | data not
                                found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="modal fade" id="deleteConfirmation{{ $book['bk_id'] }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteConfirmation{{ $book['bk_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered"
            action="/system/book/{{ $book['bk_id'] }}/delete">
            @csrf
            @method('DELETE')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Delete this data?</h5>
                    <p class="mb-0">are you sure to delete user {{ $book['name'] }}.</p>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Cancle</button>
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Submit</strong></button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="addCopy{{ $book['bk_id'] }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addCopy{{ $book['bk_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered"
            action="/system/book/{{ $book['bk_id'] }}/add/copy">
            @csrf
            <div class="modal-content rounded-3 shadow">
                <form action="/system/book/{{ $book['bk_id'] }}/add/copy" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Salinan Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="kode"
                                aria-label="kode" name="code">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" placeholder="jumlah"
                                aria-label="jumlah" name="number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </form>
            </div>
        </form>
    </div>
</x-app-layout>
