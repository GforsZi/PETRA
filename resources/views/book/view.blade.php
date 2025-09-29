<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/manage/book/add" class="btn btn-outline-primary w-100">Tambah Buku Baru</a>
    </x-slot:header_layout>
    <x-table_data :paginator="$books">
        <x-slot:title>Manage Book</x-slot:title>

        <div class="row w-100">
            @forelse ($books as $index => $book)
                <div class="col-sm-4 my-4 ">
                    <div class="card mx-2 book-card h-100 p-3">
                        <img src="{{ asset($book->bk_img_url ?? 'logo/book_placeholder.jpg') }}"
                            class="card-img-top object-fit-contain cover" alt=""
                            height="200" />
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-wrap">{{ $book->bk_title }}</h5>
                            <p class="card-text text-wrap">
                                <strong>Penulis:</strong>
                                @foreach ($book->authors as $author)
                                    {{ $author->athr_name }}
                                @endforeach
                            </p>
                            <p class="card-text"><small class="text-muted">Tahun Terbit:
                                </small>{{ $book->bk_published_year }} </p>
                        </div>
                        <div class="d-flex w-100 align-items-center">
                            <div class="dropdown-center ms-2 w-100">
                                <button class="btn btn-outline-warning w-100 dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-menu-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="/manage/book/{{ $book->bk_id }}/detail">Detail</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="/manage/book/{{ $book->bk_id }}/edit">Ubah</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="20" class="w-100 text-center">404 | data not found</td>
                </tr>
            @endforelse
        </div>
    </x-table_data>
</x-app-layout>
