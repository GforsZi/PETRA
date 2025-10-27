<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Kesalahan: {{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="/system/transaction/add" method="POST">
        @csrf
        <div class="row g-4 align-items-start">

            <div class="col-md-4">
                <h5 class="mb-3">Buku yang Dipinjam</h5>
                <div id="listBukuDipilih" class="border rounded p-2 bg-body" style="max-height: 300px; overflow-y: auto;">
                    <p class="text-muted m-0" id="noBukuText">Belum ada buku dipilih</p>
                </div>

                <button id="btnPilihBuku" type="button" class="btn btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-container="body" data-bs-placement="bottom"
                    data-bs-trigger="hover focus" data-bs-content="Untuk memilih buku, pastikan anda menentukan tujuan peminjaman terlebih dahulu">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Pilih Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- search -->
                    <div class="input-group mb-3 shadow-sm border border-body rounded">
                        <input id="book-search" type="text" class="form-control border-0" placeholder="Cari buku..." aria-label="Search">
                        <button class="btn btn-primary border-0 px-4 d-flex align-items-center justify-content-center" type="button">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>

                    <div class="container text-center border" style="height: 300px; max-height: 300px; overflow-y: auto;">
                        <h3>Hasil Pencarian</h3>
                        <hr>
                        <div class="row row-cols-2 row-cols-lg-3 g-3" id="book-list"></div>
                        <br>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-title {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* maksimal 2 baris */
            -webkit-box-orient: vertical;
            white-space: normal;
            word-break: break-word;
            cursor: help;
            /* biar kelihatan bisa di-hover */
        }
    </style>

    <script>
        const bokList = document.getElementById('book-list');
        const tujuanSelect = document.getElementById('tujuanSelect');
        const listContainer = document.getElementById('listBukuDipilih');
        const btnPilihBuku = document.getElementById('btnPilihBuku');

        // cari buku
        document.getElementById('book-search').addEventListener('keyup', function() {
            let query = this.value;

            fetch("{{ route('books.search') }}?q=" + query + "&purpose=" + tujuanSelect.value)
                .then(res => res.json())
                .then(data => {
                    bokList.innerHTML = '';
                    data.forEach(book => {
                        let div = document.createElement('div');
                        div.classList.add('col', 'd-flex',
                            'justify-content-center');

                        const copiesData = JSON.stringify(book.book_copies || []);

                        let imgSrc = book.bk_img_url ?
                            `{{ asset('${book.bk_img_url}') }}` :
                            `{{ asset('logo/book_placeholder.jpg') }}`;

                        div.innerHTML = `
        <div class="card h-100 p-1 border shadow-sm" style="max-width: 140px;">
            <img src="${imgSrc}"
                class="object-fit-contain pilih-buku"
                style="cursor: pointer;height: 167px; width: 128px;"
                data-id="${book.bk_id}"
                data-nama="${book.bk_title || 'Buku ' + book.bk_id}"
                data-copies='${copiesData}'
                title="${book.bk_title}">
            <p class="card-title text-start text-wrap mb-0"
                title="${book.bk_title}"
                style="word-wrap: break-word; white-space: normal; font-size: 0.9rem; float: none;
                overflow: hidden; text-overflow: ellipsis; display: -webkit-box;
                -webkit-line-clamp: 2; -webkit-box-orient: vertical; cursor: help;">
                ${book.bk_title}
            </p>
        </div>
    `;
                        bokList.appendChild(div);
                    });
                });
        });

        
        // POPUP SAAT PILIH BUKU
       
        const listBukuDipilih = document.getElementById('listBukuDipilih');
        let popoverInstance = null;

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('pilih-buku')) {
                // jika ada popover sebelumnya, hapus dulu
                if (popoverInstance) {
                    popoverInstance.dispose();
                }

                // hitung jumlah card yang ada di dalam listBukuDipilih
                const jumlahCard = listBukuDipilih.querySelectorAll('.card').length;

                // ✅ pastikan popover tidak muncul sebelum ada card sama sekali
                if (jumlahCard === 0) {
                    return; // keluar tanpa menampilkan popover
                }

                // tentukan pesan berdasarkan pola jumlah card
                let pesanPopover = '';
                if (tujuanSelect.value === "1") {
                    pesanPopover = 'Untuk peminjaman KBM, hanya dapat 1 buku saja';
                } else if (tujuanSelect.value === "2") {
                    pesanPopover = 'Untuk peminjaman pribadi, maksimal hanya 3 buku saja';
                } else {
                    pesanPopover = 'Silakan pilih tujuan peminjaman terlebih dahulu';
                }

                // buat popover baru di atas list buku
                popoverInstance = new bootstrap.Popover(listBukuDipilih, {
                    content: pesanPopover,
                    placement: 'top',
                    trigger: 'manual',
                    html: true
                });

                popoverInstance.show();

                // hilangkan otomatis setelah 2 detik
                setTimeout(() => {
                    if (popoverInstance) {
                        popoverInstance.dispose();
                        popoverInstance = null;
                    }
                }, 3000);
            }
        });

        // ✅ popover otomatis menyesuaikan isi pesan ketika tujuan berubah
        tujuanSelect.addEventListener('change', function() {
            if (popoverInstance) {
                popoverInstance.dispose();
            }

            // hanya tampilkan kalau sudah ada card di list
            const jumlahCard = listBukuDipilih.querySelectorAll('.card').length;
            if (jumlahCard === 0) return;

            let pesanPopover = '';
            if (this.value === "1") {
                pesanPopover = 'Untuk peminjaman KBM, hanya dapat 1 buku saja';
            } else if (this.value === "2") {
                pesanPopover = 'Untuk peminjaman pribadi, maksimal hanya 3 buku saja';
            } else {
                pesanPopover = 'Silakan pilih tujuan peminjaman terlebih dahulu';
            }

            popoverInstance = new bootstrap.Popover(listBukuDipilih, {
                content: pesanPopover,
                placement: 'top',
                trigger: 'manual',
                html: true
            });

            popoverInstance.show();

            setTimeout(() => {
                if (popoverInstance) {
                    popoverInstance.dispose();
                    popoverInstance = null;
                }
            }, 2000);
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

    //reset
    const bokList = document.getElementById('book-list');
    if (bokList) bokList.innerHTML = '';
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

                // 🔸 tambahkan select hanya jika tujuan = (Pribadi)
                // Ambil data salinan dari atribut data-copies
                const copies = JSON.parse(e.target.dataset.copies || '[]');

                let options = '<option value="" selected disabled>Pilih salinan</option>';
                copies.forEach(copy => {
                    const disabled = copy.bk_cp_status != 1 ? 'disabled' : '';
                    const statusLabel = copy.bk_cp_status != 1 ? ' (Tidak Tersedia)' : '';

                    options += `
        <option value="${copy.bk_cp_id}" ${disabled}>
            ${copy.bk_cp_number}${statusLabel}
        </option>
    `;
                });

                const selectHTML = (tujuan === "2" && copies.length > 0) ? `
    <select class="form-select w-100 me-2" name="trx_copy_id[]" required>
        ${options}
    </select>
` : '';



                card.innerHTML = `
            <div class="row g-0 align-items-stretch">
                <div class="col-4">
                    <img src="${e.target.src}" class="img-fluid rounded-start h-100"
                        alt="buku" style="object-fit:cover;">
                </div>
                <div class="col-8 d-flex flex-column justify-content-between">
                    <div class="p-2 d-flex justify-content-between align-items-center">
                        <h6 class="card-title fw-bold mb-0" title="${e.target.dataset.nama}">${e.target.dataset.nama}</h6>

                    </div>
                    <div class="p-2 d-flex justify-content-end">
                        ${selectHTML}
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
                updateButtonVisibility();


                // tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById(
                    'exampleModal'));
                modal.hide();

                updateButtonVisibility();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btnPilihBuku');
            const popover = new bootstrap.Popover(btn);
        });
    </script>

</x-app-layout>
