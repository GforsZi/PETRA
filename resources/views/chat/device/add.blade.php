<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Perangkat Baru</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="{{ route('chat.store') }}" method="post">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Perangkat</label>
                    <div class="col-sm-10">
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Perangkat</label>
                    <div class="col-sm-10">
                        <input type="text" name="device"
                            class="form-control @error('device') is-invalid @enderror"
                            id="inputEmail3">
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
