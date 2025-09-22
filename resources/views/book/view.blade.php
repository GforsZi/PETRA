<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header_layout>
        <a href="/manage/book/add" class="btn btn-outline-primary w-100">Tambah Buku Baru</a>
    </x-slot:header_layout>
    <x-table_data :paginator="$books">
        <x-slot:title>Manage Book</x-slot:title>

        <div class="row w-100">
            @forelse ($books as $index => $book)
                <div class="col-sm-4 mb-4">
                    <div class="card mx-2 book-card h-100 p-3">
                        <img src="{{ asset($book->bk_img_url ?? 'logo/uni_invt.png') }}"
                            class="card-img-top cover" alt="" />
                        <div class="card-body">
                            <h5 class="card-title text-wrap">{{ $book->bk_title }}</h5><br>
                            <p class="card-text text-wrap">
                                <strong>Penulis:</strong>
                                @foreach ($book->authors as $author)
                                    {{ $author->athr_name }}
                                @endforeach
                            </p>
                            <p class="card-text text-wrap"><strong>Penerbit:</strong>
                                {{ $book->publisher->pub_name ?? '' }}</p>
                            <p class="card-text"><small class="text-muted">Terbit:
                                </small>{{ $book->bk_published_year }} </p>
                        </div>
                        <a href="detail.html?id=${item.id || '-'}"
                            class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-menu-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="/manage/book/{{ $book->bk_id }}/detail">Detail</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="/manage/book/{{ $book->bk_id }}/edit">Ubah</a>
                                </li>
                                <li><a class="dropdown-item" style="cursor: pointer;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteConfirmation{{ $books->firstItem() + $index }}">Hapus</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteConfirmation{{ $books->firstItem() + $index }}"
                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="deleteConfirmation{{ $books->firstItem() + $index }}Label"
                    aria-hidden="true">
                    <form action="/system/book/{{ $book->bk_id }}/delete" method="post"
                        class="modal-dialog modal-dialog-centered">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content rounded-3 shadow">
                            <div class="modal-body p-4 text-center">
                                <h5 class="mb-0">Konfirmasi</h5>
                                <p class="mb-0">Yakin ingin menghapus data ini?
                                    {{ $books->firstItem() + $index }}.</p>
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
            @empty
                <tr>
                    <td colspan="20" class="w-100 text-center">404 | data not found</td>
                </tr>
            @endforelse
        </div>
    </x-table_data>
</x-app-layout>
