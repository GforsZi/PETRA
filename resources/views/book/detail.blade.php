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
                            <td>{{ $book['bk_title'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>ISBN</td>
                            <td>{{ $book['bk_isbn'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>deskripsi</td>
                            <td>{{ $book['bk_description'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Tahun terbit</td>
                            <td>{{ $book['bk_published_year'] }}</td>
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
                            <td>Klasifikasi</td>
                            <td>
                                {{ $book['publisher']['pub_name'] ?? '' }}
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

                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#desc_ast"
                    aria-expanded="false" aria-controls="desc_ast">Salinan Buku</button>
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
        <div class="card-body p-0 collapse" id="desc_ast">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 30%">ID salinan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($book['bookCopies'] as $bk_cp)
                        <tr class="align-middle">
                            <td>{{ $bk_cp->bk_cp_number }}</td>
                            <td>
                                @if ($bk_cp->status == '1')
                                    Tersedia
                                @elseif ($bk_cp->status == '2')
                                    Dipinjam
                                @else
                                    Rusak
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="w-100 text-center">404 | data not
                                found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="modal fade" id="deleteConfirmation{{ $book['bk_id'] }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1"
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
                    <input hidden value="{{ $book['bk_id'] }}" />
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Submit</strong></button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
