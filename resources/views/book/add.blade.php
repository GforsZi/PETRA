<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header_layout>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
            data-bs-target="#authorModal">
            Tambah Penulis
        </button>
        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
            data-bs-target="#ddcModal">
            Tambah Klasifikasi
        </button>
    </x-slot:header_layout>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Buku Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/book/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Buku</label>
                    <div class="col-sm-10">
                        <select name="bk_type"
                            class="form-select @error('bk_type') is-invalid @enderror" required
                            aria-label="Default select example">
                            <option value="1">Fisik</option>
                            <option value="2">Digital</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ISBN Buku</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_isbn"
                            class="form-control @error('bk_isbn') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_title"
                            class="form-control @error('bk_title') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan
                        Buku</label>
                    <div class="col-sm-10">
                        <textarea name="bk_description" class="form-control @error('bk_description') is-invalid @enderror"
                            id="autoExpand" style="resize: none; overflow: hidden;"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Harga Perbuku</label>
                    <div class="col-sm-10">
                        <input type="number" name="bk_unit_price"
                            class="form-control @error('bk_unit_price') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Edisi Buku</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_edition_volume"
                            class="form-control @error('bk_edition_volume') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Diterbitkannya
                        Buku</label>
                    <div class="col-sm-10">
                        <input type="number" id="year" min="1500"
                            max="{{ date('Y') }}" step="1" name="bk_published_year"
                            class="form-control @error('bk_edition_volume') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penerbit
                        Buku</label>
                    <div class="col-sm-10">
                        <select name="bk_publisher_id"
                            class="form-select @error('bk_publisher_id') is-invalid @enderror"
                            aria-label="Default select example">
                            <option value="">Pilih Penerbit</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->pub_id }}">
                                    {{ $publisher->pub_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan
                        Buku</label>
                    <div class="col-sm-10">
                        <select name="bk_major_id"
                            class="form-select @error('bk_major_id') is-invalid @enderror"
                            aria-label="Default select example">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->bk_mjr_id }}">
                                    {{ $major->bk_mjr_class . ' ' . $major->bk_mjr_major }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Penulis Buku</label>
                    <div class="col-sm-10">
                        <select class="form-control d-none" id="selected-authors" name="authors[]"
                            multiple></select>

                        <div id="author-tags" class="mt-2">
                            {{-- badge penulis akan muncul di sini --}}
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Klasifikasi Buku</label>
                    <div class="col-sm-10">
                        <select class="form-control d-none" id="selected-ddc"
                            name="classfications[]" multiple></select>

                        <div id="ddc-tags" class="mt-2">
                            {{-- badge penulis akan muncul di sini --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="authorModal" tabindex="-1"
                aria-labelledby="authorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pilih Penulis</h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <input type="text" id="author-search" class="form-control mb-3"
                                placeholder="Cari penulis...">

                            <div id="author-list" style="max-height: 300px; overflow-y:auto;">
                                {{-- Hasil pencarian AJAX akan muncul disini --}}
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="select-authors-btn"
                                class="btn btn-primary" data-bs-dismiss="modal">
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ddcModal" tabindex="-1"
                aria-labelledby="ddcModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pilih Penulis</h5>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <input type="text" id="ddc-search" class="form-control mb-3"
                                placeholder="Cari penulis...">

                            <div id="ddc-list" style="max-height: 300px; overflow-y:auto;">
                                {{-- Hasil pencarian AJAX akan muncul disini --}}
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="select-ddc-btn" class="btn btn-primary"
                                data-bs-dismiss="modal">
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div div class="card-footer">
                <button type="submit" class="btn btn-outline-primary px-5"
                    id="tombol">submit</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <script>
        const textarea = document.getElementById("autoExpand");

        textarea.addEventListener("input", function() {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });

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
    </script>
</x-app-layout>
