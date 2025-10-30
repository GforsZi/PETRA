<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header_layout>
        <a href="/google/search/book" class="btn btn-outline-primary btn-lg w-100" title="Cari menggunakan Google"><i class="bi bi-google"></i></a>
    </x-slot:header_layout>
    <form id="searchForm" action="{{ url('/search/book') }}" method="get">
        <div class="input-group mb-3 shadow-sm border border-body rounded">
            <input type="text" id="searchInput" name="search" value="{{ request('search') }}" class="form-control border-0 bg-body" placeholder="Cari judul buku..." aria-label="Search">
            <button class="btn btn-primary border-0 px-4 d-flex align-items-center justify-content-center" type="submit">
                <i class="bi bi-search fs-5"></i>
            </button>
        </div>
    </form>

    <div class="mt-3">
        <div class="border border-body rounded p-3">
            <h5 class="mb-2 text-center p-3"><b>Hasil Pencarian</b></h5>
            <div id="searchResult" class="row row-cols-7 gx-2 gy-3 overflow-y-scroll " style="max-height: 500px;">

            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="border border-body rounded p-2">
            <h5 class="mb-2"><b>Buku Terbaru</b></h5>

            <div class="overflow-auto">
                <div class="row gx-1 flex-nowrap overflow-x-scroll justify-content-start">
                    @foreach ($book_new as $bk_nw)
                        <div class="book col border-0 mx-2 text-center rounded pt-2 custom-card" style="width: 140px; flex: 0 0 auto; overflow: hidden;">
                            <a href="/search/book/{{ $bk_nw->bk_id }}/detail" style="text-decoration: none;">
                                <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                                <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $bk_nw->bk_title }}"
                                    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                       overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                       -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                                    {{ $bk_nw->bk_title }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <div class="mt-3">
        <div class="border border-body rounded p-2">
            <h5 class="mb-2"><b>Ebook Terbaru</b></h5>

            <div class="overflow-auto">
                <div class="row gx-1 flex-nowrap overflow-x-scroll justify-content-start">
                    @foreach ($book_pdf as $ebk)
                        <div class="book col border-0 mx-2 text-center rounded pt-2 custom-card" style="width: 140px; flex: 0 0 auto; overflow: hidden;">
                            <a href="/search/book/{{ $ebk->bk_id }}/detail" style="text-decoration: none;">
                                <img src="{{ asset($ebk->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                                <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $ebk->bk_title }}"
                                    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                       overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                       -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                                    {{ $ebk->bk_title }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <div class="mt-3">
        <div class="border border-body rounded p-2">
            <h5 class="mb-2"><b>Buku fisik Terbaru</b></h5>

            <div class="overflow-auto">
                <div class="row gx-1 flex-nowrap overflow-x-scroll justify-content-start">
                    @foreach ($book as $ebk)
                        <div class="book col border-0 mx-2 text-center rounded pt-2 custom-card" style="width: 140px; flex: 0 0 auto; overflow: hidden;">
                            <a href="/search/book/{{ $ebk->bk_id }}/detail" style="text-decoration: none;">
                                <img src="{{ asset($ebk->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                                <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $ebk->bk_title }}"
                                    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                       overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                       -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                                    {{ $ebk->bk_title }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <div class="mt-3">
        <div class="border border-body rounded p-2">
            <h5 class="mb-2"><b>Buku Umum</b></h5>

            <div class="overflow-auto">
                <div class="row gx-1 flex-nowrap overflow-x-scroll justify-content-start">
                    @foreach ($book_general as $ebk)
                        <div class="book col border-0 mx-2 text-center rounded pt-2 custom-card" style="width: 140px; flex: 0 0 auto; overflow: hidden;">
                            <a href="/search/book/{{ $ebk->bk_id }}/detail" style="text-decoration: none;">
                                <img src="{{ asset($ebk->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                                <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $ebk->bk_title }}"
                                    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                       overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                       -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                                    {{ $ebk->bk_title }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <div class="mt-3">
        <div class="border border-body rounded p-2">
            <h5 class="mb-2"><b>Buku Paket</b></h5>

            <div class="overflow-auto">
                <div class="row gx-1 flex-nowrap overflow-x-scroll justify-content-start">
                    @foreach ($book_package as $ebk)
                        <div class="book col border-0 mx-2 text-center rounded pt-2 custom-card" style="width: 140px; flex: 0 0 auto; overflow: hidden;">
                            <a href="/search/book/{{ $ebk->bk_id }}/detail" style="text-decoration: none;">
                                <img src="{{ asset($ebk->bk_img_url ?? 'logo/book_placeholder.jpg') }}" class="object-fit-contain" style="height: 167px; width: 128px;">
                                <p class="text-body text-start text-wrap mt-1 mb-0" title="{{ $ebk->bk_title }}"
                                    style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                       overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                       -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                                    {{ $ebk->bk_title }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <style>
        body {
            background-color: #fff;
            /* contoh: putih */
            color: #333;
        }

        /* Card menyesuaikan dengan body tapi sedikit berbeda */
        .custom-card {
            background-color: color-mix(in srgb, var(--bs-body-bg, #fff) 90%, #000 10%);
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        /* Jika mode gelap (Bootstrap atau custom) */
        @media (prefers-color-scheme: dark) {
            .custom-card {
                background-color: color-mix(in srgb, var(--bs-body-bg, #121212) 85%, #fff 10%);
            }
        }

        @media (min-width: 992px) {
            .col-lg-1-7 {
                flex: 0 0 calc(100% / 7);
                max-width: calc(100% / 7);
            }
        }

        @media (max-width: 991.98px) {
            .col-2 {
                flex: 0 0 calc(100% / 5);
                max-width: calc(100% / 5);
            }
        }

        .book-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .overflow-auto::-webkit-scrollbar {
            display: none;
        }

        .overflow-auto {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #searchForm .form-control:hover,
        #searchForm .form-control:focus {
            background-color: #f8f9fa;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        }

        #searchForm .btn:hover,
        #searchForm .btn:focus {
            background-color: #0b5ed7;
            transform: scale(1.05);
            transition: all 0.2s ease;
        }

        .book {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .book:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.25);
        }

        .row-cols-6.gx-2.gy-3 {
            gap: 18px 8px;
            /* row gap 18px, column gap 8px */
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            /* card rapat ke kiri */
        }

        .book {
            margin: 0 !important;
            /* hilangkan margin antar card */
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('searchForm');
            const input = document.getElementById('searchInput');
            const resultContainer = document.getElementById('searchResult');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // cegah reload

                let query = input.value.trim();
                if (query === "") {
                    resultContainer.innerHTML =
                        '<p class="text-muted text-center">Masukkan kata kunci terlebih dahulu.</p>';
                    return;
                }

                fetch(`/search/book/${encodeURIComponent(query)}`, {
                        headers: {
                            "Accept": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        resultContainer.innerHTML = '';

                        if (!data || data.length === 0) {
                            resultContainer.innerHTML =
                                '<p class="text-muted text-center">Tidak ada buku ditemukan.</p>';
                            return;
                        }

                        data.forEach(book => {
                            let col = document.createElement('div');
                            col.classList.add('col', 'col-md-3',
                                'col-lg-2', 'mb-3');

                            if (book.bk_img_url) {
                                col.innerHTML = `
                                <div class="book text-center rounded pt-2" style="width: 140px;">
    <a href="/search/book/${book.bk_id}/detail" style="text-decoration: none;">
        <img src="{{ asset('${book.bk_img_url}') }}"
            class="object-fit-contain" style="height: 167px; width: 128px;" alt="${book.bk_title}">
        <div class="card-body p-2">
            <p class="text-body text-start text-wrap mt-1 mb-0"
               title="${book.bk_title}"
               style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                      overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                      -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                ${book.bk_title}
            </p>
        </div>
    </a>
</div>

                            `;
                            } else {
                                col.innerHTML = `
    <div class="book text-center rounded pt-2 custom-card" style="width: 140px; min-height: 240px;">
    <a href="/search/book/${book.bk_id}/detail" style="text-decoration: none;">
        <img src="{{ asset('logo/book_placeholder.jpg') }}"
            class="object-fit-contain" style="height: 167px; width: 128px;" alt="${book.bk_title}">
        <p class="text-body text-start text-wrap mt-1 mb-0"
           title="${book.bk_title}"
           style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;
                  overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                  -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
            ${book.bk_title}
        </p>
    </a>
</div>



                            `;
                            }

                            resultContainer.appendChild(col);
                        });
                    })
                    .catch(err => {
                        console.error(err);
                        resultContainer.innerHTML =
                            '<p class="text-danger">Terjadi kesalahan.</p>';
                    });
            });
        });
    </script>

</x-app-layout>
