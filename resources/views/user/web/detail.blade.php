<x-app-layout>
    <x-slot:title>Detail Buku - Google</x-slot:title>
    <div class="container mt-4">
    <div class="row g-3">

        <!-- Card Buku -->
        <div class="col-12 col-lg-6">
            <div class="card h-100">
                <div class="row g-0">

                    <div class="col-md-5 p-4 d-flex justify-content-center align-items-center">
                        <img id="book-image" src="" alt="Cover Buku"
                            class="object-fit-contain rounded shadow-sm"
                            style="height: 167px; width: 128px;">
                    </div>

                    <div class="col">
                        <div class="card-body flex-column d-flex">
                            <h3 id="book-title" class="card-title fw-bold mb-4">Judul Buku</h3>

                            <div class="mb-2">
                                <strong>Penulis:</strong>
                                <span class="ms-2" id="book-author">-</span>
                            </div>

                            <div class="mb-2">
                                <strong>Penerbit:</strong>
                                <span class="ms-2" id="book-publisher">-</span>
                            </div>

                            <div class="mb-2">
                                <strong>Tanggal Terbit:</strong>
                                <span class="ms-2" id="book-date">-</span>
                            </div>

                            <div class="mb-2">
                                <strong>Halaman:</strong>
                                <span class="ms-2" id="book-pages">-</span>
                            </div>

                            <div class="mb-2">
                                <strong>Kategori:</strong>
                                <span class="ms-2" id="book-categories">-</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold">Deskripsi</h5>
                    <p id="book-desc" class="text-muted" style="margin-top:0; white-space: pre-line;">
                        <!-- Deskripsi -->
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        const params = new URLSearchParams(window.location.search);
        const bookId = params.get('id');

        if (bookId) {
            fetch(`https://www.googleapis.com/books/v1/volumes/${bookId}`)
                .then(res => res.json())
                .then(data => {
                    const info = data.volumeInfo;

                    document.getElementById('book-title').textContent = info.title || 'Tanpa Judul';
                    document.getElementById('book-author').textContent = (info.authors || []).join(', ') || '-';
                    document.getElementById('book-publisher').textContent = info.publisher || '-';
                    document.getElementById('book-date').textContent = info.publishedDate || '-';
                    document.getElementById('book-pages').textContent = info.pageCount || '-';
                    document.getElementById('book-categories').textContent = (info.categories || []).join(', ') || '-';
                    document.getElementById('book-desc').innerHTML = info.description || 'Deskripsi tidak tersedia.';

                    const image = info.imageLinks?.thumbnail || '';
                    document.getElementById('book-image').src = image;

                    // Tambahkan animasi idle jika ada cover
                    if (image) {
                        gsap.to("#book-image", {
                            y: -10,
                            duration: 2,
                            repeat: -1,
                            yoyo: true,
                            ease: "power1.inOut"
                        });
                    }
                });
        }
    </script>
</x-app-layout>
