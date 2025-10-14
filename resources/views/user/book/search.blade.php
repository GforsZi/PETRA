<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form id="searchForm" action="{{ url('/search/book') }}" method="get">
        <div class="input-group mb-3 shadow-sm border border-body rounded">
            <input type="text" id="searchInput" name="search" value="{{ request('search') }}"
                class="form-control border-0" placeholder="Cari judul buku..." aria-label="Search">
            <button
                class="btn btn-primary border-0 px-4 d-flex align-items-center justify-content-center"
                type="submit">
                <i class="bi bi-search fs-5"></i>
            </button>
        </div>
    </form>

    <div class="mt-3">
        <div class="border border-body rounded p-3">
            <h5 class="mb-2"><b>Hasil Pencarian</b></h5>
            <div id="searchResult" class="row gx-1 flex-nowrap overflow-x-scroll"></div>
        </div>
    </div>

    <div class="mt-3">
        <div class="border border-body rounded p-2">
            <h5 class="mb-2"><b>Buku Terbaru</b></h5>

            <div class="overflow-auto">
                <div class="row gx-1 flex-nowrap overflow-x-scroll justify-content-start">
                    @foreach ($book_new as $bk_nw)
                        <div class="book col border mx-2 text-center rounded pt-2"
                            style="width: 140px; flex: 0 0 auto; overflow: hidden;">
                            <a href="/search/book/{{ $bk_nw->bk_id }}/detail" style="text-decoration: none;">
                                <img src="{{ asset($bk_nw->bk_img_url ?? 'logo/book_placeholder.jpg') }}"
                                    class="object-fit-contain"
                                    style="height: 167px; width: 128px;">
                                <p class="text-body text-wrap mt-1 mb-0"
                                style="word-wrap: break-word; white-space: normal; width: 128px; margin: 0 auto;">
                                    {{ $bk_nw->bk_title }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
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
                        '<p class="text-muted">Masukkan kata kunci dulu.</p>';
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
                                '<p class="text-muted">Tidak ada buku ditemukan.</p>';
                            return;
                        }

                        data.forEach(book => {
                            let col = document.createElement('div');
                            col.classList.add('col', 'col-md-3',
                                'col-lg-2', 'mb-3');

                            if (book.bk_img_url) {
                                col.innerHTML = `
                                <div class="book text-center rounded pt-2" style="width: 140px;">
                                    <a href="/search/book/${book.bk_id}/detail"
                                    style="text-decoration: none;">
                                    <img src="{{ asset('${book.bk_img_url}') }}"
                                        class="object-fit-contain" style="height: 167px; width: 128px;" alt="${book.bk_title}">
                                    <div class="card-body p-2">
                                        <p class="text-body text-wrap">${book.bk_title}</p>
                                    </div>
                                    </a>
                                </div>
                            `;
                            } else {
                                col.innerHTML = `
                                <div class="book text-center rounded pt-2" style="width: 140px;">
                                    <a href="/search/book/${book.bk_id}/detail"
                                    style="text-decoration: none;">
                                    <img src="{{ asset('logo/book_placeholder.jpg') }}"
                                        class="object-fit-contain" style="height: 167px; width: 128px;" alt="${book.bk_title}">
                                    <div class="card-body p-2">
                                        <p class="text-body text-wrap">${book.bk_title}</p>
                                    </div>
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
