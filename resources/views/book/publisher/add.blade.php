<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Penerbit Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/publisher/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="wajib diisi, hanya boleh huruf, maksimal 255 karakter.">Nama
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('pub_name') }}" type="text" name="pub_name" class="form-control @error('pub_name') is-invalid @enderror" id="inputEmail3">
                        @error('pub_name')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="wajib diisi dengan teks yang sesuai, maksimal 255 karakter.">Alamat
                    </label>
                    <div class="col-sm-10">
                        <input value="{{ old('pub_address') }}" type="text" name="pub_address" class="form-control @error('pub_address') is-invalid @enderror" id="inputEmail3">
                        @error('pub_address')
                            <div class="invalid-feedback">
                                <p style="text-align: right;"> {{ $message }}</p>
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
