<x-app-layout>
    <x-slot:title>Cari menggunakan Google</x-slot:title>

    <style>
        body {
            background-color: #fff;
            color: #333;
        }

        .book-card {
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: scale(1.02);
        }

        .cover {
            max-height: 200px;
            object-fit: contain;
        }
    </style>
    </head>

    <body>

        <div class="container">
            <h1 class="text-center mb-4" data-aos="fade-down">Pencarian Buku</h1>

            <div class="input-group mb-5" data-aos="fade-up">
                <input type="text" id="search" class="form-control" placeholder="Masukkan judul buku" />
                <button class="btn btn-primary" onclick="searchBooks()">Cari</button>
            </div>

            <div class="row" id="results" data-aos="fade-up" data-aos-delay="200">
                <!-- Hasil pencarian ditampilkan di sini -->
            </div>
        </div>
    </body>

    <script>
        async function searchBooks() {
            const query = document.getElementById('search').value.trim();
            const resultsContainer = document.getElementById('results');
            resultsContainer.innerHTML = '';

            if (!query) {
                resultsContainer.innerHTML = `<div class="col text-center text-muted">Masukkan kata kunci pencarian.</div>`;
                return;
            }

            try {
                const res = await fetch(`/system/book/google?q=${encodeURIComponent(query)}`);
                const data = await res.json();

                if (data.error) {
                    resultsContainer.innerHTML = `<div class="col text-center text-danger">${data.error}</div>`;
                    return;
                }

                if (data.items && data.items.length > 0) {
                    data.items.forEach((item) => {
                        const book = item.volumeInfo;
                        const col = document.createElement('div');
                        col.className = 'col-md-4 mb-4';

                        col.innerHTML = `
                        <div class="card book-card h-100 p-3">
                            <img src="${book.imageLinks?.thumbnail || 'https://via.placeholder.com/150'}" class="card-img-top cover" alt="${book.title}" />
                            <div class="card-body">
                                <h5 class="card-title">${book.title}</h5>
                            </div>
                            <a href="/google/search/book/detail?id=${item.id || '-'}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        </div>
                    `;

                        resultsContainer.appendChild(col);
                    });
                } else {
                    resultsContainer.innerHTML = `<div class="col text-center text-muted">Buku tidak ditemukan.</div>`;
                }
            } catch (error) {
                console.error('Error:', error);
                resultsContainer.innerHTML = `<div class="col text-center text-danger">Terjadi kesalahan dalam pemrosesan data.</div>`;
            }
        }
    </script>

</x-app-layout>
