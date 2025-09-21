<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Ubah Penulis</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/author/{{ $authors['athr_id'] }}/edit" method="post">
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" name="athr_name" value="{{ $authors['athr_name'] }}"
                            class="form-control @error('athr_name') is-invalid @enderror"
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
