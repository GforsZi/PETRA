<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Jurusan Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/major/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="wajib diisi dengan angka saja.">Tingkatan
                        Kelas</label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_mjr_class') }}" type="text" name="bk_mjr_class" class="form-control @error('bk_mjr_class') is-invalid @enderror" id="inputEmail3">
                        @error('bk_mjr_class')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="wajib diisi, berupa teks, maksimal 255 karakter.">Nama
                        jurusan</label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_mjr_major') }}" type="text" name="bk_mjr_major" class="form-control @error('bk_mjr_major') is-invalid @enderror" id="inputEmail3">
                        @error('bk_mjr_major')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div div class="card-footer">
                <button type="submit" class="btn btn-outline-primary px-5" id="tombol" onclick="this.disabled=true; this.form.submit();">submit</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</x-app-layout>
