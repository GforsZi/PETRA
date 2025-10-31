<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Kesalahan: {{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Opsi Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/option/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Judul
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('cht_opt_title') }}" type="text" name="cht_opt_title" class="form-control @error('cht_opt_title') is-invalid @enderror" id="title">
                        @error('cht_opt_title')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="message" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Pesan
                    </label>
                    <div class="col-sm-10">
                        <textarea name="cht_opt_message" id="message" class="form-control @error('cht_opt_message') is-invalid @enderror" id="autoExpand">{{ old('cht_opt_message') }}</textarea>
                        @error('cht_opt_message')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Tipe Pesan</label>
                    <div class="col-sm-10">
                        <select name="cht_opt_type" class="form-select @error('cht_opt_type') is-invalid @enderror" required aria-label="Default select example" id="type">
                            <option value="1">Pemberitahuan aktifasi</option>
                            <option value="2">Peringatan waktu peminjaman</option>
                            <option value="3">Pesan bantuan</option>
                        </select>
                        @error('cht_opt_type')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">{{ $message }}</p>
                            </div>
                        @enderror
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
</x-app-layout>
