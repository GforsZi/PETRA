<x-app-layout>
    <x-slot:title>Detail Buku - Google</x-slot:title>
    <div class="container py-5">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img id="book-image" src="" alt="Cover Buku" class="img-fluid rounded shadow-sm" style="max-height: 350px;">
            </div>
            <div class="col-md-8">
                <h2 id="book-title" class="fw-bold mb-3">Judul Buku</h2>
                <p><strong>Penulis:</strong> <span id="book-author">-</span></p>
                <p><strong>Penerbit:</strong> <span id="book-publisher">-</span></p>
                <p><strong>Tanggal Terbit:</strong> <span id="book-date">-</span></p>
                <p><strong>Halaman:</strong> <span id="book-pages">-</span></p>
                <p><strong>Kategori:</strong> <span id="book-categories">-</span></p>
            </div>
        </div>

        <div class="row mt-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col">
                <h4 class="fw-semibold">Deskripsi</h4>
                <p id="book-desc" class="text-muted">Deskripsi buku akan ditampilkan di sini...</p>
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
