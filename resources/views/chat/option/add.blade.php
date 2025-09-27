<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Opsi Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/option/add" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Judul opsi</label>
                    <div class="col-sm-10">
                        <input type="text" name="cht_opt_title"
                            class="form-control @error('cht_opt_title') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Pesan opsi</label>
                    <div class="col-sm-10">
                        <textarea name="cht_opt_message" class="form-control @error('cht_opt_message') is-invalid @enderror"
                            id="autoExpand" style="resize: none; overflow: hidden;"></textarea>
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
