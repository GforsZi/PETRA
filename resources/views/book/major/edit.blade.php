<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Ubah Klasifikasi Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/major/{{ $major['bk_mjr_id'] }}/edit" method="post">
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Untuk output yang akan tampil berbentuk apa kepada user, apakah buku fisik atau versi digital.">
                        Tingkatan
                    </label>
                    <div class="col-sm-10">
                        <select name="bk_mjr_class" id="image-option" class="form-select @error('bk_mjr_class') is-invalid @enderror" required aria-label="Default select example">
                            <option value="1">X</option>
                            <option value="2">XI</option>
                            <option value="3">XII</option>
                        </select>
                        @error('bk_mjr_class')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus"
                        data-bs-title="Pemberitahuan" data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_mjr_major" value="{{ $major['bk_mjr_major'] }}" class="form-control @error('bk_mjr_major') is-invalid @enderror" id="inputEmail3">
                        @error('bk_mjr_major')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">{{ $message }}</p>
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
