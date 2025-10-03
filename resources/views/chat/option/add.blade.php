<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Error: {{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
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
                    <label for="title" class="col-sm-2 col-form-label">Judul opsi</label>
                    <div class="col-sm-10">
                        <input value="{{ old('cht_opt_title') }}" type="text" name="cht_opt_title"
                            class="form-control @error('cht_opt_title') is-invalid @enderror"
                            id="title">
                        @error('cht_opt_title')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="message" class="col-sm-2 col-form-label">Pesan opsi</label>
                    <div class="col-sm-10">
                        <textarea name="cht_opt_message" id="message"
                            class="form-control @error('cht_opt_message') is-invalid @enderror" id="autoExpand">{{ old('cht_opt_message') }}</textarea>
                        @error('cht_opt_message')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Tipe Pesan</label>
                    <div class="col-sm-10">
                        <select name="cht_opt_type"
                            class="form-select @error('cht_opt_type') is-invalid @enderror" required
                            aria-label="Default select example" id="type">
                            <option value="1">Pemberitahuan aktifasi</option>
                            <option value="2">Peringatan waktu peminjaman</option>
                            <option value="3">Pesan bantuan</option>
                        </select>
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
</x-app-layout>
