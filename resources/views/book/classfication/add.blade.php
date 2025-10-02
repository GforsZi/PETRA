<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Klasifikasi Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/ddc/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Code Klasifikasi</label>
                    <div class="col-sm-10">
                        <input value="{{ old('ddc_code') }}" type="text" name="ddc_code"
                            class="form-control @error('ddc_code') is-invalid @enderror"
                            id="inputEmail3">
                            @error('ddc_code')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan
                        Klasifikasi</label>
                    <div class="col-sm-10">
                        <textarea name="ddc_description" class="form-control @error('ddc_description') is-invalid @enderror"
                            id="autoExpand">{{ old('ddc_description') }}</textarea>
                            @error('ddc_description')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Input tidak sesuai</p>
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
