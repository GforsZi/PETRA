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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Peran</label>
                    <div class="col-sm-10">
                        <input type="text" name="rl_name"
                            class="form-control @error('rl_name') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan
                        Peran</label>
                    <div class="col-sm-10">
                        <textarea name="rl_description" class="form-control @error('rl_description') is-invalid @enderror"
                            id="autoExpand"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <input class="form-check-input @error('rl_admin') is-invalid @enderror"
                            name="rl_admin" value="1" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            Admin
                        </label>
                    </div>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary px-5"
                    id="tombol">submit</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</x-app-layout>
