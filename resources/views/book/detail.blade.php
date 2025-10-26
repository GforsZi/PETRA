<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row g-0 p-3 bg-body rounded">
        <div class="col-12 col-md-4 d-flex justify-content-center">
            <img src="{{ asset($book['bk_img_url'] ?? 'logo/book_placeholder.jpg') }}" class="img-fluid shadow" style="height: 300px; width: auto; object-fit: contain;"
                alt="Book cover showing classical painting and dark themed cover">

        </div>
        <div class="col-12 col-md-8 ps-md-3 mt-3 mt-md-0">

            <h5>
                @if ($book['bk_type'] == '1')
                    Buku Fisik
                @elseif ($book['bk_type'] == '2')
                    Buku Digital
                @endif
            </h5>
            <h4 class="fw-bold mb-1">{{ $book['bk_title'] ?? '' }}</h4>
            <p class="mb-1 text-primary">
                <a href="#" class="text-decoration-none">
                    @foreach ($book['authors'] as $author)
                        {{ $author->athr_name }}
                        @if (!$loop->last)
                            &
                        @endif
                    @endforeach
                </a> | no isbn {{ $book['bk_isbn'] ?? '' }}
            </p>
            <hr class="mb-1">
            <p class="text-muted" id="text" style="line-height: 1.5; white-space: pre-line; word-wrap: break-word; overflow-wrap: break-word;">
                {{ $book['bk_description'] ?? '' }}
            </p>

        </div>
    </div>

    <div class="card my-4  col-12 col-md-8 w-100">
        <div class="card-header">
            <h3 class="card-title">Detail Buku</h3>
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
                        <td>Perizinan</td>
                        <td>
                            @if ($book['bk_permission'] == '1')
                                Dapat dipinjam
                            @elseif ($book['bk_permission'] == '2')
                                Tidak dapat dipinjam
                            @endif
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>Judul</td>
                        <td>{{ $book['bk_title'] ?? '' }}</td>
                    </tr>
                    @if ($book['major'])
                        <tr class="align-middle">
                            <td>Jurusan</td>
                            <td>{{ $book['major']['bk_mjr_class'] . ' ' . $book['major']['bk_mjr_major'] ?? '' }}
                            </td>
                        </tr>
                    @endif
                    <tr class="align-middle">
                        <td>ISBN</td>
                        <td>{{ $book['bk_isbn'] ?? '' }}</td>
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
                                <span class="badge text-bg-primary">{{ $author->athr_name }}</span>
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
                        <td>Alamat penerbit</td>
                        <td>
                            {{ $book['publisher']['pub_address'] ?? '' }}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>Tahun terbit</td>
                        <td>{{ $book['bk_published_year'] ?? '' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Pemberian</td>
                        <td>
                            {{ $book['origin']['bk_orgn_name'] ?? '' }}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>Edisi</td>
                        <td>
                            {{ $book['bk_edition_volume'] ?? '' }}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>Harga Satuan</td>
                        <td>
                            {{ 'Rp' . number_format($book['bk_unit_price'] ?? 0, 0, ',', '.') ?? '' }}
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>Harga Keseluruhan</td>
                        <td>
                            {{ 'Rp' . number_format($book['bk_unit_price'] * $book['bookCopies']->count() ?? 0, 0, ',', '.') ?? '' }}
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
            @if ($book['bk_type'] == '2')
                <a class="btn btn-lg btn-success" title="Lihat Ebook" href="/manage/book/{{ $book['bk_id'] }}/pdf"><i class="bi bi-book"></i></a>
            @endif
            <a class="btn btn-lg btn-danger"style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $book['bk_id'] }}" title="Hapus Buku"><i class="bi bi-trash"></i></a>

        </div>
    </div>
    @if ($book['bk_type'] == '1')
        <div class="card mb-4">
            <div class="card-header d-flex">
                <h3 class="card-title w-100">Salinan Buku</h3>
                <div class="card-tools d-flex justify-content-end w-100 ">
                    <a class="btn btn-lg btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#addCopy{{ $book['bk_id'] }}" aria-expanded="false" aria-controls="desc_ast"
                        title="Tambah Salinan Buku"><i class="bi bi-plus-lg"></i></a>
                    @if ($book['bookCopies']->toArray() != [])
                        <a class="btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCopiesModal" title="Hapus Banyak Salinan Buku">
                            <i class="bi bi-trash"></i>
                        </a>

                        <a class="btn btn-lg btn-success float-end mx-1" style="cursor: pointer;" href="/manage/book/{{ $book['bk_id'] }}/detail/print_label" title="Cetak Label">
                            <i class="bi bi-printer-fill"></i>
                        </a>
                    @endif
                </div>
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
                                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-menu-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#LabelBook{{ $bk_cp->bk_cp_id }}">
                                                    Label
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#changeStatus{{ $bk_cp->bk_cp_id }}">Ubah
                                                    Status</a>
                                            </li>
                                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $bk_cp->bk_cp_id }}">Hapus</a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="modal fade" id="deleteConfirmation{{ $bk_cp->bk_cp_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="deleteConfirmation{{ $bk_cp->bk_cp_id }}Label" aria-hidden="true">
                                        <form action="/system/book/copy/{{ $bk_cp->bk_cp_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content rounded-3 shadow">
                                                <div class="modal-body p-4 text-center">
                                                    <h5 class="mb-0">Menghapus data..</h5>
                                                    <p class="mb-0">Apakah anda yakin untuk
                                                        menghapus
                                                        salinan ini?
                                                    </p>
                                                    <div class="alert mt-4 alert-warning d-flex text-start align-items-center" role="alert">
                                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                                        <div>
                                                            Penghapusan ini bersifat <strong>soft
                                                                delete</strong> — data masih dapat
                                                            dipulihkan dari halaman riwayat.
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="{{ $book['bk_id'] }}" name="book_id" />
                                                </div>
                                                <div class="modal-footer flex-nowrap p-0">
                                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                                                        onclick="this.disabled=true; this.form.submit();"><strong>Hapus</strong></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal fade" id="LabelBook{{ $bk_cp->bk_cp_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="LabelBook{{ $bk_cp->bk_cp_id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-3 shadow p-3">
                                                <div class="labelcode mx-auto" style="width: 450px; border: 2px solid black; font-family: Arial, sans-serif;">

                                                    <table style="width:100%; border-bottom:2px solid black; border-collapse: collapse;">
                                                        <tr style="height:90px;">
                                                            <td class="p-0 m-0" style="width:100px; border-right:2px solid black; text-align:center; vertical-align:middle;">
                                                                <img src="{{ asset('logo/landing/smk.png') }}" alt="Logo Petra" style="width:80px; height:80px;" class="rounded-circle">
                                                            </td>
                                                            <td style="text-align:center; vertical-align:middle;">
                                                                <h5 class="fw-bold mb-0">
                                                                    PERPUSTAKAAN
                                                                </h5>
                                                                <h5 class="fw-bold mb-0">SMK
                                                                    MAHAPUTRA
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                    </table>

                                                    <div class="text-center py-3">
                                                        <h4 class="fw-bold mb-1">
                                                            @php
                                                                $ddcs = $book['deweyDecimalClassfications']->pluck('ddc_code')->take(2)->implode('.');
                                                            @endphp

                                                            <span>{{ $ddcs ?: '-' }}</span>
                                                        </h4>
                                                        <h5 class="fw-bold mb-1">
                                                            @foreach ($book['authors'] as $author)
                                                                <span>{{ Str::substr(strtoupper($author->athr_name), 0, 3) }}</span>
                                                                @if (!$loop->last)
                                                                    .
                                                                @endif
                                                            @endforeach
                                                        </h5>
                                                        <p class="mb-1">
                                                            {{ Str::substr(strtolower($book['bk_title']), 0, 1) ?? '' }}
                                                        </p>
                                                        <p class="mb-0 fw-bold">
                                                            {{ $bk_cp->bk_cp_number }}</p>
                                                    </div>
                                                </div>

                                                <div class="modal-footer flex-nowrap p-0 mt-3">
                                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-12 py-3 m-0 rounded-0" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($book['bk_permission'] == '1')
                                            <style>
                                                .labelcode {
                                                    background-color: white;
                                                    color: black;
                                                }
                                            </style>
                                        @elseif ($book['bk_permission'] == '2')
                                            <style>
                                                .labelcode {
                                                    background-color: #EF5A6F;
                                                    color: black;
                                                }
                                            </style>
                                        @endif
                                    </div>

                                    <div class="modal fade" id="changeStatus{{ $bk_cp->bk_cp_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="changeStatus{{ $bk_cp->bk_cp_id }}Label" aria-hidden="true">
                                        <form action="/system/book/copy/{{ $bk_cp->bk_cp_id }}/edit" method="post" class="modal-dialog modal-dialog-centered">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content rounded-3 shadow">
                                                <div class="modal-body p-4 text-center">
                                                    <h5 class="mb-3">Ubah Status</h5>
                                                    <input type="hidden" value="{{ $book['bk_id'] }}" name="book_id">
                                                    <select name="bk_cp_status" class="form-select @error('bk_cp_status') is-invalid @enderror" required aria-label="Default select example">
                                                        <option value="1">Tersedia
                                                        </option>
                                                        <option value="2">Dipinjam</option>
                                                        <option value="3">Hilang</option>
                                                        <option value="4">Rusak</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer flex-nowrap p-0">
                                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                                                        onclick="this.disabled=true; this.form.submit();"><strong>Ubah</strong></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal fade" id="deleteCopiesModal" tabindex="-1" aria-labelledby="deleteCopiesModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/system/book/copy/delete/many" method="POST" class="modal-content shadow-sm">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteCopiesModalLabel">Hapus Salinan
                                                        Buku
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p class="text-muted mb-2">
                                                        Pilih salinan yang ingin Anda hapus. Tekan
                                                        <kbd>Ctrl</kbd> (atau <kbd>Cmd</kbd> di Mac)
                                                        untuk memilih lebih dari satu.
                                                    </p>

                                                    <div class="mb-3">
                                                        <label for="copy_ids" class="form-label fw-semibold">Pilih
                                                            Salinan Buku</label>
                                                        <select name="copy_ids[]" id="copy_ids" class="form-select" multiple required>
                                                            @foreach ($book['bookCopies'] as $copy)
                                                                <option value="{{ $copy->bk_cp_id }}">
                                                                    {{ $copy->bk_cp_number }} —
                                                                    {{ $copy->book->bk_title ?? 'Tidak diketahui' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                                        <div>
                                                            Penghapusan ini bersifat <strong>soft
                                                                delete</strong> — data masih dapat
                                                            dipulihkan dari halaman riwayat.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash" onclick="this.disabled=true; this.form.submit();"></i>
                                                        Hapus Terpilih
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="w-100 text-center">404 | data tidak
                                    ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    @endif
    <div class="modal fade" id="deleteConfirmation{{ $book['bk_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteConfirmation{{ $book['bk_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered" action="/system/book/{{ $book['bk_id'] }}/delete">
            @csrf
            @method('DELETE')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Konfirmasi</h5>
                    <p class="mb-0">Yakin ingin menghapus data ini?</p>
                    <div class="alert mt-4 alert-warning d-flex text-start align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <div>
                            Penghapusan ini bersifat <strong>soft
                                delete</strong> — data masih dapat
                            dipulihkan dari halaman riwayat.
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                        onclick="this.disabled=true; this.form.submit();"><strong>Ya</strong></button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="addCopy{{ $book['bk_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCopy{{ $book['bk_id'] }}Label"
        aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered" action="/system/book/{{ $book['bk_id'] }}/add/copy">
            @csrf
            <div class="modal-content rounded-3 shadow">
                <form action="/system/book/{{ $book['bk_id'] }}/add/copy" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Salinan Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" value="{{ collect(explode(' ', strtoupper(trim($book['bk_title']))))->filter()->map(fn($word) => Str::substr($word, 0, 1))->implode('') }}"
                                class="form-control" placeholder="kode" aria-label="kode" name="code">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" placeholder="jumlah" aria-label="jumlah" name="number">
                            @error('number')
                                <div class="invalid-feedback">
                                    <p style="text-align: right;">Input tidak sesuai</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Buat salinan</button>
                    </div>
                </form>
            </div>
        </form>
    </div>
    <script>
        const el = document.getElementById('text');
        el.textContent = el.textContent.replace(/^\s*\n/, '');
    </script>
</x-app-layout>
