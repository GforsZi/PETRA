<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('error'))
        <div class="alert alert-error alert-dismissible fade show" role="alert">
            <h5>Error: {{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <form action="/system/transaction/add" method="POST">
        @csrf
        <div class="row g-4 align-items-start">

            <div class="col-md-4">
                <h5 class="mb-3">Buku yang Dipinjam</h5>
                <div id="listBukuDipilih" class="border rounded p-2 bg-body"
                    style="max-height: 300px; overflow-y: auto;">
                    <p class="text-muted m-0" id="noBukuText">Belum ada buku dipilih</p>
                </div>

                <button id="btnPilihBuku" type="button" class="btn btn-primary mt-3 w-100"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Pilih Buku
                </button>
            </div>

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Tujuan Peminjaman</label>
                    <select class="form-select" name="trx_title" id="tujuanSelect" required>
                        <option value="" selected disabled>Pilih tujuan</option>
                        <option value="1">Kegiatan Belajar Mengajar</option>
                        <option value="2">Pribadi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="trx_description"></textarea>
                </div>

                <!-- tanggal otomatis -->
                <input type="hidden" name="trx_borrow_date" value="{{ now() }}">

                <button type="submit" class="btn btn-outline-success w-100" onclick="this.disabled=true; this.form.submit();">Selesai</button>
            </div>
        </div>
    </form>

    <!-- Modal Pilih Buku -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- search -->
                    <div class="input-group mb-3 shadow-sm border border-body rounded">
                        <input id="book-search" type="text" class="form-control border-0"
                            placeholder="Cari sesuatu..." aria-label="Search">
                        <button
                            class="btn btn-primary border-0 px-4 d-flex align-items-center justify-content-center"
                            type="button">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>

                    <div class="container text-center border"
                        style="height: 300px; max-height: 300px; overflow-y: auto;">
                        <h3>Hasil Pencarian</h3>
                        <hr>
                        <div class="row row-cols-2 row-cols-lg-3 g-3" id="book-list"></div>
                        <br>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const bokList = document.getElementById('book-list');
        const tujuanSelect = document.getElementById('tujuanSelect');
        const listContainer = document.getElementById('listBukuDipilih');
        const btnPilihBuku = document.getElementById('btnPilihBuku');

        // cari buku
        document.getElementById('book-search').addEventListener('keyup', function() {
            let query = this.value;

            fetch("{{ route('books.search') }}?q=" + query)
                .then(res => res.json())
                .then(data => {
                    bokList.innerHTML = '';
                    data.forEach(book => {
                        let div = document.createElement('div');
                        div.classList.add('col', 'd-flex',
                            'justify-content-center');
                        let imgSrc = book.bk_img_url ?
                            `{{ asset('${book.bk_img_url}') }}` :
                            `{{ asset('logo/book_placeholder.jpg') }}`;
                        div.innerHTML = `
                        <div class="card h-100 p-1 border shadow-sm" style="max-width: 140px;">
                        <img src="${imgSrc}"
                            class="object-fit-contain pilih-buku"
                            style="cursor: pointer;height: 167px; width: 128px;"
                            data-id="${book.bk_id}" title="${book.bk_title}"
                            data-nama="${book.bk_title || 'Buku ' + book.bk_id}">
                            <div class="card-body m-0 p-0">
                                <p class="card-title text-start text-wrap mb-0" style="word-wrap: break-word; white-space: normal; font-size: 0.9rem; float: none;">${book.bk_title}</p>
                            </div>
                        </div>
                    `;
                        bokList.appendChild(div);
                    });
                });
        });

        // update tombol
        function updateButtonVisibility() {
            const tujuan = tujuanSelect.value;
            const count = listContainer.querySelectorAll('.card').length;

            if (!tujuan) {
                btnPilihBuku.style.display = 'block';
                return;
            }

            if (tujuan === "1" && count >= 1) {
                btnPilihBuku.style.display = 'none';
            } else if (tujuan === "2" && count >= 3) {
                btnPilihBuku.style.display = 'none';
            } else {
                btnPilihBuku.style.display = 'block';
            }
        }

        // jika tujuan berubah
        tujuanSelect.addEventListener('change', () => {
            listContainer.innerHTML =
                '<p class="text-muted m-0" id="noBukuText">Belum ada buku dipilih</p>';
            updateButtonVisibility();
        });

        // klik pilih buku
        bokList.addEventListener('click', function(e) {
            if (e.target.classList.contains('pilih-buku')) {
                const tujuan = tujuanSelect.value;
                if (!tujuan) {
                    alert("Pilih tujuan peminjaman terlebih dahulu!");
                    return;
                }

                const currentCount = listContainer.querySelectorAll('.card').length;

                if (tujuan === "1" && currentCount >= 1) {
                    alert("Untuk kegiatan belajar mengajar hanya boleh 1 buku.");
                    return;
                }
                if (tujuan === "2" && currentCount >= 3) {
                    alert("Untuk tujuan pribadi hanya boleh maksimal 3 buku.");
                    return;
                }

                const noText = document.getElementById('noBukuText');
                if (noText) noText.remove();

                const card = document.createElement('div');
                card.className = "card mb-2 shadow-sm bg-body";
                card.style.maxWidth = "100%";

                const bookId = e.target.dataset.id;

                card.innerHTML = `
                <div class="row g-0 align-items-stretch">
                    <div class="col-4">
                        <img src="${e.target.src}" class="img-fluid rounded-start h-100"
                            alt="buku" style="object-fit:cover;">
                    </div>
                    <div class="col-8 d-flex flex-column justify-content-between">
                        <div class="p-2 d-flex justify-content-between align-items-center">
                            <h6 class="card-title fw-bold mb-0">${e.target.dataset.nama}</h6>
                        </div>
                        <div class="p-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger hapus-buku">Hapus</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="book_ids[]" value="${bookId}">
            `;

                // tombol hapus
                card.querySelector('.hapus-buku').addEventListener('click', () => {
                    card.remove();
                    if (listContainer.querySelectorAll('.card').length === 0) {
                        listContainer.innerHTML =
                            '<p class="text-muted m-0" id="noBukuText">Belum ada buku dipilih</p>';
                    }
                    updateButtonVisibility();
                });

                listContainer.appendChild(card);

                // tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById(
                    'exampleModal'));
                modal.hide();

                updateButtonVisibility();
            }
        });
    </script>

</x-app-layout>
