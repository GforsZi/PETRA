<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Klasifikasi Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/major/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tingkatan Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_mjr_class"
                            class="form-control @error('bk_mjr_class') is-invalid @enderror"
                            id="inputEmail3">
                            @error('bk_mjr_class')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">' {{ old('bk_mjr_class') }} ' Merupakan input yang tidak sesuai dengan format kelas</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan Kelas
                        Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_mjr_major"
                            class="form-control @error('bk_mjr_major') is-invalid @enderror"
                            id="inputEmail3">
                            @error('bk_mjr_major')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">' {{ old('bk_mjr_major') }} ' Merupakan input yang tidak sesuai dengan format kejuruan</p>
                            </div>
                        @enderror
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
