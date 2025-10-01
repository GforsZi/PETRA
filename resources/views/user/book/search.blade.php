<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form id="searchForm" action="{{ url('/search/book') }}" method="get">
        <div class="input-group mb-3 shadow-sm border border-body rounded">
            <input type="text" id="searchInput" name="search" value="{{ request('search') }}"
                class="form-control border-0" placeholder="Cari judul buku..."
                aria-label="Search">
            <button
                class="btn btn-primary border-0 px-4 d-flex align-items-center justify-content-center"
                type="submit">
                <i class="bi bi-search fs-5"></i>
            </button>
        </div>
    </form>

    <div class="container mt-3">
        <div class="border border-body rounded p-3">
            <h5 class="mb-2"><b>Hasil Pencarian</b></h5>
            <div id="searchResult" class="row gx-2 gy-2"></div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="border border-body rounded p-2">

            <h5 class="mb-2"><b>Buku Terpopuler</b></h5>

            <div class="overflow-auto">
                <div class="row flex-nowrap gx-1">

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 1">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 2">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 3">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 4">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 5">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 6">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 7">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="border border-body rounded p-2">

            <h5 class="mb-2"><b>Buku Terbaru</b></h5>

            <div class="overflow-auto">
                <div class="row flex-nowrap gx-1">

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 1">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 2">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 3">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 4">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 5">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 6">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 7">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="border border-body  rounded p-2">

            <h5 class="mb-2"><b>Buku Pelajaran</b></h5>

            <div class="overflow-auto">
                <div class="row flex-nowrap gx-1">

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 1">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 2">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 3">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 4">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 5">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 6">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 7">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="border border-body rounded p-2">

            <h5 class="mb-2"><b>Buku Novel</b></h5>

            <div class="overflow-auto">
                <div class="row flex-nowrap gx-1">

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 1">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 2">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 3">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 4">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 5">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 6">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 7">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

                    <div class="col-2 col-lg-1-7">
                        <img src="{{ asset('logo/landing/Aesop.png') }}"
                            class="img-fluid rounded book-img" alt="Buku 8">
                    </div>

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

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // cegah reload

            let query = input.value.trim();
            if (query === "") {
                resultContainer.innerHTML = '<p class="text-muted">Masukkan kata kunci dulu.</p>';
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
                        col.classList.add('col-6', 'col-md-3', 'col-lg-2', 'mb-3');

                        col.innerHTML = `
                            <div class="card h-100 shadow-sm">
                                <img src="${book.cover_url ?? '{{ asset("logo/landing/Aesop.png") }}'}"
                                    class="card-img-top book-img" alt="${book.bk_title}">
                                <div class="card-body p-2">
                                    <p class="small text-center mb-0">${book.bk_title}</p>
                                </div>
                            </div>
                        `;

                        resultContainer.appendChild(col);
                    });
                })
                .catch(err => {
                    console.error(err);
                    resultContainer.innerHTML = '<p class="text-danger">Terjadi kesalahan.</p>';
                });
        });
    });
    </script>


</x-app-layout>
