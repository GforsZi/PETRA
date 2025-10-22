<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Peran Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/role/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" data-bs-container="body"
                        data-bs-toggle="popover" data-bs-placement="bottom"
                        data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Nama
                        Peran</label>
                    <div class="col-sm-10">
                        <input value="{{ old('rl_name') }}" type="text" name="rl_name"
                            class="form-control @error('rl_name') is-invalid @enderror"
                            id="inputEmail3">
                        @error('rl_name')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">' {{ old('rl_name') }} ' Input tidak
                                    termasuk ke dalam format Peran yang valid</p>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label"
                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                        data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Keterangan
                        Peran</label>
                    <div class="col-sm-10">
                        <textarea name="rl_description" class="form-control @error('rl_description') is-invalid @enderror"
                            id="autoExpand">{{ old('rl_description') }}</textarea>
                        @error('rl_description')
                            <div class="invalid-feedback">
                                <p style="text-align: right;">' {{ old('rl_descripytion') }} ' ... Input
                                    melebihi jumlah karakter Maksimal</p>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <input class="form-check-input @error('rl_admin') is-invalid @enderror"
                            name="rl_admin" value="1" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1" data-bs-container="body"
                            data-bs-toggle="popover" data-bs-placement="bottom"
                            data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                            data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">
                            Admin
                        </label>
                    </div>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary px-5" id="tombol"
                    onclick="this.disabled=true; this.form.submit();">submit</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</x-app-layout>
