<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Asal Buku Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/origin/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pemberi</label>
                    <div class="col-sm-10">
                        <input value="{{ old('bk_orgn_name') }}" type="text" name="bk_orgn_name"
                            class="form-control @error('bk_orgn_name') is-invalid @enderror"
                            id="inputEmail3">
                        @error('bk_orgn_name')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">Nama Asal Buku tidak sesuai</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alasan Buku
                        Diberikan</label>
                    <div class="col-sm-10">
                        <textarea name="bk_orgn_description" id="message"
                            class="form-control @error('bk_orgn_description') is-invalid @enderror" id="autoExpand"> {{ old('bk_orgn_description') }} </textarea>
                        @error('bk_orgn_description')
                            <div class="invalid-feedback">
                                <p style="text-align: right;"> Alamat tidak sesuai</p>
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
