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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tingkatan Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_mjr_class"
                            value="{{ $major['bk_mjr_class'] }}"
                            class="form-control @error('bk_mjr_class') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan Kelas
                        Klasifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="bk_mjr_major"
                            value="{{ $major['bk_mjr_major'] }}"
                            class="form-control @error('bk_mjr_major') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
            </div>
            <div div class="card-footer">
                <button type="submit" class="btn btn-outline-warning px-5"
                    id="tombol">submit</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</x-app-layout>
