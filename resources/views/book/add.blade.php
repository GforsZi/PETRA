<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header_layout>

    </x-slot:header_layout>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Buku Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/book/add" method="post" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Ketersediaan buku, untuk mengatur setiap buku yang ada apakah bisa di pinjam atau tidak">Ketersediaan</label>
                    <div class="col-sm-10">
                        <select name="bk_permission" class="form-select @error('bk_permission') is-invalid @enderror" required aria-label="Default select example">
                            <option value="1">Dapat dipinjam</option>
                            <option value="2">Tidak untuk dipinjam</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Untuk output yang akan tampil berbentuk apa kepada user">Jenis
                    </label>
                    <div class="col-sm-10">
                        <select name="bk_type" id="image-option" class="form-select @error('bk_type') is-invalid @enderror" required aria-label="Default select example">
                            <option value="1">Fisik</option>
                            <option value="2">Digital</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Unggah file gambar (jpg, jpeg, png) maksimal 2 MB untuk dijadikan sampul buku.">Sampul
                    </label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    </div>
                </div>
                <div class="mb-3" id="image-container"></div>
                <div class="row mb-3">
                    <label for="sibn" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan"
                        data-bs-content="Masukkan nomor ISBN yang valid (misalnya: 978-602-441-123-4). ISBN harus unik dan sesuai format standar internasional. Kosongkan jika buku tidak memiliki ISBN.">ISBN
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_isbn') }}" type="text" name="bk_isbn" class="form-control @error('bk_isbn') is-invalid @enderror" id="sibn">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Wajib diisi. Tulis judul lengkap buku sesuai sampul depan. Hindari singkatan atau simbol yang tidak perlu.">Judul
                        Buku</label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_title') }}" type="text" name="bk_title" class="form-control @error('bk_title') is-invalid @enderror" id="title">
                        @error('bk_title')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Opsional. Tambahkan deskripsi singkat mengenai isi atau tujuan buku (maksimal 65.535 karakter).">Keterangan
                        Buku</label>
                    <div class="col-sm-10">
                        <textarea name="bk_description" class="form-control @error('bk_description') is-invalid @enderror" id="autoExpand">{{ old('bk_description') }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Masukkan harga buku dalam angka (tanpa titik atau koma). Bisa dikosongkan jika buku tidak dijual.">Harga
                        Satuan</label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_unit price') }}" type="number" name="bk_unit_price" class="form-control @error('bk_unit_price') is-invalid @enderror" id="price">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="page" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Masukkan data jumlah halaman pada buku">Halaman
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_page') }}" type="number" name="bk_page" class="form-control @error('bk_page') is-invalid @enderror" id="page">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edition" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Tuliskan edisi atau volume buku, misalnya Edisi Revisi Kedua atau Volume 1.">Edisi
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_edition_volume') }}" type="text" name="bk_edition_volume" class="form-control @error('bk_edition_volume') is-invalid @enderror" id="edition">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="published" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Masukkan tahun terbit (4 digit, antara 1901-sekarang).">Tahun
                        Terbit
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_published_year') }}" type="number" id="published" min="1901" max="{{ date('Y') }}" step="1" name="bk_published_year"
                            class="form-control @error('bk_published_year') is-invalid @enderror" id="published">
                    </div>
                </div>
                <div class="mb-3 row position-relative">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Pilih penerbit dari daftar yang tersedia. Pastikan penerbit sudah terdaftar di sistem.">Penerbit
                    </label>
                    <div class="col-sm-10 position-relative">
                        <div class="position-relative">

                            <input type="text" id="publisher-input" class="form-control pe-5 @error('bk_publisher_id') is-invalid @enderror" autocomplete="off"
                                value="{{ $book['publisher']['pub_name'] ?? '' }}">
                            <input type="hidden" name="bk_publisher_id" id="publisher-id" value="{{ $book['bk_publisher_id'] ?? '' }}">
                            <button type="button" id="clear-publisher" class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2" style="display:none;">❌</button>
                            <div id="publisher-suggestions" class="list-group position-absolute shadow-sm" style="z-index:1000; display:none; width:100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row position-relative">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Pilih asal buku, seperti Pembelian, Donasi, atau Bantuan Sekolah.">Sumber
                    </label>
                    <div class="col-sm-10 position-relative">
                        <div class="position-relative">
                            <input type="text" id="origin-input" class="form-control pe-5 @error('bk_origin_id') is-invalid @enderror" autocomplete="off"
                                value="{{ old('bk_orgn_name', $book['origin']['bk_orgn_name'] ?? '') }}">
                            <input type="hidden" name="bk_origin_id" id="origin-id" value="{{ old('bk_origin_id', $book['bk_origin_id'] ?? '') }}">
                            <button type="button" id="clear-origin" class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2" style="display:none;">❌</button>
                            <div id="origin-suggestions" class="list-group position-absolute shadow-sm" style="z-index:1000; display:none; width:100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Pilih jurusan yang relevan dengan isi buku. Misalnya: Rekayasa Perangkat Lunak atau Desain Komunikasi Visual.">Jurusan
                    </label>
                    <div class="col-sm-10">
                        <select name="bk_major_id" class="form-select @error('bk_major_id') is-invalid @enderror" aria-label="Default select example">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->bk_mjr_id }}">
                                    {{ $major->bk_mjr_class . ' ' . $major->bk_mjr_major }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan"
                        data-bs-content="Tuliskan nama penulis utama buku, atau tim penyusun jika ditulis oleh beberapa orang. Gunakan format nama lengkap tanpa gelar akademik, misalnya: Budi Santoso atau Tim Penulis Pusat Kurikulum.">
                        Penulis
                    </label>

                    <div class="col-sm-10 d-flex align-items-start">
                        <div class="flex-grow-1">
                            <select class="form-control d-none" id="selected-authors" name="authors[]" multiple></select>

                            <div id="author-tags" class="mt-2">
                                {{-- badge penulis akan muncul di sini --}}
                            </div>
                        </div>

                        <button type="button" class="btn btn-lg btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#authorModal" title="Tambah Penulis">
                            <i class="bi bi-person-plus-fill"></i>
                        </button>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan"
                        data-bs-content="Pilih kode klasifikasi buku berdasarkan sistem Dewey Decimal Classification (DDC), misalnya 499.221 untuk Bahasa Indonesia atau 510 untuk Matematika. Klasifikasi ini membantu pengelompokan buku di perpustakaan agar lebih mudah dicari.">
                        Klasifikasi
                    </label>

                    <div class="col-sm-10 d-flex align-items-start">
                        <div class="flex-grow-1">
                            <select class="form-control d-none" id="selected-ddc" name="classfications[]" multiple></select>

                            <div id="ddc-tags" class="mt-2">
                                {{-- badge klasifikasi akan muncul di sini --}}
                            </div>
                        </div>

                        <button type="button" class="btn btn-lg btn-outline-warning ms-2" data-bs-toggle="modal" data-bs-target="#ddcModal" title="Masukkan Klasifikasi">
                            <i class="bi bi-123"></i>
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pilih penulis</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <input type="text" id="author-search" class="form-control mb-3" placeholder="Cari penulis...">

                                <div id="author-list" style="max-height: 300px; overflow-y:auto;">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" id="select-authors-btn" class="btn btn-primary" data-bs-dismiss="modal">
                                    Pilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ddcModal" tabindex="-1" aria-labelledby="ddcModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pilih klasifikasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <input type="text" id="ddc-search" class="form-control mb-3" placeholder="Cari klasifikasi...">

                                <div id="ddc-list" style="max-height: 300px; overflow-y:auto;">
                                    {{-- Hasil pencarian AJAX akan muncul disini --}}
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" id="select-ddc-btn" class="btn btn-primary" data-bs-dismiss="modal">
                                    Pilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary px-5" id="tombol" onclick="this.disabled=true; this.form.submit();">Kirim</button>
                </div>
                <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <script>
        // Ambil elemen
        let authorList = document.getElementById('author-list');
        let selectedAuthors = document.getElementById('selected-authors');
        let authorTags = document.getElementById('author-tags');
        let chosen = {}; // simpan penulis yang dipilih

        // Fungsi pencarian penulis
        document.getElementById('author-search').addEventListener('keyup', function() {
            let query = this.value;

            fetch("{{ route('authors.search') }}?q=" + query)
                .then(res => res.json())
                .then(data => {
                    authorList.innerHTML = '';
                    data.forEach(author => {
                        let div = document.createElement('div');
                        div.classList.add('form-check');
                        div.innerHTML = `
                    <input class="form-check-input" type="checkbox" value="${author.athr_id}" id="author-${author.athr_id}">
                    <label class="form-check-label" for="author-${author.athr_id}">
                        ${author.athr_name}
                    </label>
                `;
                        authorList.appendChild(div);
                    });
                });
        });

        // Jika tombol pilih ditekan
        document.getElementById('select-authors-btn').addEventListener('click', function() {
            let checkboxes = authorList.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(cb => {
                if (!chosen[cb.value]) {
                    let id = cb.value;
                    let name = cb.nextElementSibling.innerText;
                    chosen[id] = name;

                    // Tambah ke <select multiple>
                    let option = document.createElement('option');
                    option.value = id;
                    option.text = name;
                    option.selected = true;
                    selectedAuthors.appendChild(option);

                    // Tambah badge ke daftar
                    let badge = document.createElement('span');
                    badge.classList.add('badge', 'bg-primary', 'me-1', 'mb-1');
                    badge.setAttribute('data-id', id);
                    badge.innerHTML =
                        `${name} <span class="ms-1 text-light" style="cursor:pointer;">&times;</span>`;

                    // Event klik x → hapus
                    badge.querySelector('span').addEventListener('click', function() {
                        // hapus dari chosen
                        delete chosen[id];
                        // hapus option di select
                        selectedAuthors.querySelector(`option[value="${id}"]`)
                            .remove();
                        // hapus badge
                        badge.remove();
                    });

                    authorTags.appendChild(badge);
                }
            });
        });

        let ddcList = document.getElementById('ddc-list');
        let selected_ddc = document.getElementById('selected-ddc');
        let ddcTags = document.getElementById('ddc-tags');
        let chosenddc = {}; // simpan penulis yang dipilih

        // Fungsi pencarian penulis
        document.getElementById('ddc-search').addEventListener('keyup', function() {
            let query = this.value;

            fetch("{{ route('ddc.search') }}?q=" + query)
                .then(res => res.json())
                .then(data => {
                    ddcList.innerHTML = '';
                    data.forEach(ddc => {
                        let div = document.createElement('div');
                        div.classList.add('form-check');
                        div.innerHTML = `
                    <input class="form-check-input" type="checkbox" value="${ddc.ddc_id}" id="ddc-${ddc.ddc_id}">
                    <label class="form-check-label" for="ddc-${ddc.ddc_id}">
                        ${ddc.ddc_code}
                    </label>
                `;
                        ddcList.appendChild(div);
                    });
                });
        });

        // Jika tombol pilih ditekan
        document.getElementById('select-ddc-btn').addEventListener('click', function() {
            let checkboxes = ddcList.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(cb => {
                if (!chosenddc[cb.value]) {
                    let id = cb.value;
                    let name = cb.nextElementSibling.innerText;
                    chosenddc[id] = name;

                    // Tambah ke <select multiple>
                    let option = document.createElement('option');
                    option.value = id;
                    option.text = name;
                    option.selected = true;
                    selected_ddc.appendChild(option);

                    // Tambah badge ke daftar
                    let badge = document.createElement('span');
                    badge.classList.add('badge', 'bg-warning', 'me-1', 'mb-1');
                    badge.setAttribute('data-id', id);
                    badge.innerHTML =
                        `${name} <span class="ms-1 text-light" style="cursor:pointer;">&times;</span>`;

                    // Event klik x → hapus
                    badge.querySelector('span').addEventListener('click', function() {
                        // hapus dari chosenddc
                        delete chosenddc[id];
                        // hapus option di select
                        selected_ddc.querySelector(`option[value="${id}"]`)
                            .remove();
                        // hapus badge
                        badge.remove();
                    });

                    ddcTags.appendChild(badge);
                }
            });
        });

        document.getElementById('image-option').addEventListener('change', function() {
            let container = document.getElementById('image-container');
            container.innerHTML = ''; // kosongkan setiap kali pilihan berubah

            if (this.value === '2') {
                container.innerHTML = `
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">PDF</label>
                <div class="col-sm-10">
                    <input type="file"
                        id="inputImage"
                        class="form-control @error('file_pdf') is-invalid @enderror"
                        name="file_pdf"
                        accept="file_pdf/*">
                    @error('file_pdf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        `;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            console.log('publisher ready');

            const input_pub = document.getElementById('publisher-input');
            const hiddenId_pub = document.getElementById('publisher-id');
            const suggestionsBox_pub = document.getElementById('publisher-suggestions');
            const clearBtn_pub = document.getElementById('clear-publisher');

            // tampilkan tombol X kalau ada teks
            function toggleClearButton() {
                clearBtn_pub.style.display = input_pub.value.trim() ? 'block' : 'none';
            }

            // tombol hapus input & id
            clearBtn_pub.addEventListener('click', function() {
                input_pub.value = '';
                hiddenId_pub.value = '';
                toggleClearButton();
                suggestionsBox_pub.style.display = 'none';
            });

            // tampilkan riwayat input saat fokus
            input_pub.addEventListener('focus', function() {
                if (history.length > 0) {
                    suggestionsBox_pub.innerHTML = '';
                    history.forEach(item => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.classList.add('list-group-item',
                            'list-group-item-action');
                        btn.textContent = item.name;
                        btn.addEventListener('click', function() {
                            input_pub.value = item.name;
                            hiddenId_pub.value = item.id;
                            suggestionsBox_pub.style.display = 'none';
                            toggleClearButton();
                        });
                        suggestionsBox_pub.appendChild(btn);
                    });
                    suggestionsBox_pub.style.display = 'block';
                }
            });

            // fetch suggestion dari server saat mengetik
            input_pub.addEventListener('keyup', function() {
                const query = this.value.trim();
                toggleClearButton();

                if (query.length === 0) {
                    suggestionsBox_pub.style.display = 'none';
                    return;
                }

                fetch(
                        `{{ route('publishers.search') }}?q=${encodeURIComponent(query) }`
                    )
                    .then(res => res.json())
                    .then(data => {
                        suggestionsBox_pub.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(pub => {
                                console.log(pub.pub_id);

                                const item = document.createElement(
                                    'button');
                                item.type = 'button';
                                item.classList.add('list-group-item',
                                    'list-group-item-action');
                                item.textContent = pub.pub_name;

                                item.addEventListener('click', function() {
                                    input_pub.value = pub.pub_name;
                                    hiddenId_pub.value = pub.pub_id;
                                    suggestionsBox_pub.style
                                        .display = 'none';
                                    toggleClearButton();
                                });

                                suggestionsBox_pub.appendChild(item);
                            });
                            suggestionsBox_pub.style.display = 'block';
                        } else {
                            suggestionsBox_pub.style.display = 'none';
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        suggestionsBox_pub.style.display = 'none';
                    });
            });

            // klik di luar → tutup suggestion
            document.addEventListener('click', function(e) {
                if (!input_pub.contains(e.target) && !suggestionsBox_pub.contains(e
                        .target)) {
                    suggestionsBox_pub.style.display = 'none';
                }
            });

            // tampilkan tombol X kalau ada value awal
            toggleClearButton();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const input_org = document.getElementById('origin-input');
            const hiddenId_org = document.getElementById('origin-id');
            const suggestionsBox_org = document.getElementById('origin-suggestions');
            const clearBtn = document.getElementById('clear-origin');

            // tampilkan tombol X kalau ada teks
            function toggleClearButton() {
                clearBtn.style.display = input_org.value.trim() ? 'block' : 'none';
            }

            // hapus input & id
            clearBtn.addEventListener('click', function() {
                input_org.value = '';
                hiddenId_org.value = '';
                toggleClearButton();
                suggestionsBox_org.style.display = 'none';
            });

            // tampilkan saran riwayat saat fokus
            input_org.addEventListener('focus', function() {
                if (history.length > 0) {
                    suggestionsBox_org.innerHTML = '';
                    history.forEach(item => {
                        let btn = document.createElement('button');
                        btn.type = 'button';
                        btn.classList.add('list-group-item',
                            'list-group-item-action');
                        btn.textContent = item.name;
                        btn.addEventListener('click', function() {
                            input_org.value = item.name;
                            hiddenId_org.value = item.id;
                            suggestionsBox_org.style.display = 'none';
                            toggleClearButton();
                        });
                        suggestionsBox_org.appendChild(btn);
                    });
                    suggestionsBox_org.style.display = 'block';
                }
            });

            // ambil data dari server saat user mengetik
            input_org.addEventListener('keyup', function() {
                const query = this.value.trim();
                toggleClearButton();

                if (query.length === 0) {
                    suggestionsBox_org.style.display = 'none';
                    return;
                }

                fetch(`{{ route('origins.search') }}?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        suggestionsBox_org.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(orgn => {
                                let item = document.createElement('button');
                                item.type = 'button';
                                item.classList.add('list-group-item',
                                    'list-group-item-action');
                                item.textContent = orgn.bk_orgn_name;

                                item.addEventListener('click', function() {
                                    input_org.value = orgn
                                        .bk_orgn_name;
                                    hiddenId_org.value = orgn
                                        .bk_orgn_id;
                                    suggestionsBox_org.style
                                        .display = 'none';
                                    toggleClearButton();
                                });

                                suggestionsBox_org.appendChild(item);
                            });
                            suggestionsBox_org.style.display = 'block';
                        } else {
                            suggestionsBox_org.style.display = 'none';
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        suggestionsBox_org.style.display = 'none';
                    });
            });

            // klik di luar → tutup suggestion
            document.addEventListener('click', function(e) {
                if (!input_org.contains(e.target) && !suggestionsBox_org.contains(e
                        .target)) {
                    suggestionsBox_org.style.display = 'none';
                }
            });

            // inisialisasi awal
            toggleClearButton();
        });
    </script>
</x-app-layout>
