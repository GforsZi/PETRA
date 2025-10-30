<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Ubah Penerbit</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/publisher/{{ $publishers['pub_id'] }}/edit" method="post">
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="wajib diisi, hanya boleh huruf, maksimal 255 karakter.">Nama
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="pub_name" value="{{ $publishers['pub_name'] }}" class="form-control @error('athr_name') is-invalid @enderror" id="inputEmail3">
                        @error('pub_name')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Nama penerbit tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="wajib diisi dengan teks yang sesuai, maksimal 255 karakter.">Alamat
                    </label>
                    <div class="col-sm-10">
                        <input type="text" name="pub_address" value="{{ $publishers['pub_address'] }}" class="form-control @error('athr_name') is-invalid @enderror" id="inputEmail3">
                        @error('pub_address')
                            <div class="invalid-feedback">
                                <p style="text-align: right;"> Alamat tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div div class="card-footer">
                <button type="submit" class="btn btn-outline-warning px-5" id="tombol" onclick="this.disabled=true; this.form.submit();">Kirim</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</x-app-layout>
