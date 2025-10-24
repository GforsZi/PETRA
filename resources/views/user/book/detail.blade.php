<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header_layout>
        <a href="/search/book/{{ $book['bk_id'] }}/detail/ebook" class="btn btn-success btn-lg w-100" title="Tambahkan Opsi"><i class="bi bi-book"></i></a>
    </x-slot:header_layout>

    <div class="container mt-4">
        <div class="row g-3">

            <!-- Card Buku -->
            <div class="col-12 col-lg-6">
                <div class="card h-100">
                    <div class="row g-0">

                        <div class="col-md-5 p-4 d-flex justify-content-center align-items-center">
                            <img src="{{ asset($book['bk_img_url'] ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;" alt="Buku">
                        </div>

                        <div class="col">
                            <div class="card-body flex-column d-flex">
                                <h3 class="card-title fw-bold mb-4">{{ $book['bk_title'] ?? '' }}
                                </h3>
                                <div class="mb-2"><strong>Penulis:</strong> <span class="ms-2">
                                        @foreach ($book['authors'] as $author)
                                            {{ $author->athr_name ?? '' }} @if (!$loop->last)
                                                |
                                            @endif
                                        @endforeach
                                    </span></div> <!-- isian data disini -->
                                <div class="mb-2"><strong>Penerbit:</strong> <span class="ms-2">
                                        {{ $book['publisher']['pub_name'] ?? '' }}
                                    </span></div>
                                <div class="mb-2"><strong>Tahun terbit:</strong> <span class="ms-2"> {{ $book['bk_published_year'] ?? '' }}
                                    </span>
                                </div>
                                <div class="mb-2"><strong>Halaman:</strong> <span class="ms-2">
                                        {{ $book['bk_page'] ?? '' }}
                                    </span></div>
                                <div class="mb-2"><strong>Klasifikasi:</strong> <span class="ms-2">
                                        @foreach ($book['deweyDecimalClassfications'] as $classfication)
                                            {{ $classfication->ddc_code ?? '' }} @if (!$loop->last)
                                                |
                                            @endif
                                        @endforeach
                                    </span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 ">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">Deskripsi</h5>

                        <p id="text" class="text-muted" style="margin-top:0; white-space: pre-line;">
                            {!! trim($book['bk_description']) ?? '' !!}

                        </p>

                        <!-- isian descripsi  -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        const el = document.getElementById('text');
        el.textContent = el.textContent.replace(/^\s*\n/, '');
    </script>
</x-app-layout>
