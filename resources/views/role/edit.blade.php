<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Edit role</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/role/{{ $role[0]['rl_id'] }}/edit" method="post">
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ubah Nama Peran</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control @error('rl_name') is-invalid @enderror"
                            name="rl_name" value="{{ $role[0]['rl_name'] }}" id="inputEmail3">
                            @error('rl_name')
                                <div class="invalid-feedback">
                                    <p style="text-align: right;">' {{ old('rl_name') }} ' Input tidak termasuk ke dalam format Peran yang valid</p>
                                </div>
                            @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Ubah Keterangan
                        Peran</label>
                    <div class="col-sm-10">
                        <textarea name="rl_description" class="form-control @error('rl_description') is-invalid @enderror"
                            id="autoExpand">{{ $role[0]['rl_description'] }}</textarea>
                            @error('rl_description')
                                <div class="invalid-feedback">
                                    <p style="text-align: right;">' {{ old('rl_descripytion') }} ' ... Input melebihi jumlah karakter Maksimal</p>
                                </div>
                            @enderror
                    </div>
                </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            @if ($role[0]['rl_admin'])
                                <input class="form-check-input" name="rl_admin" type="hidden"
                                    value="0" id="gridCheck1">
                                <input class="form-check-input" name="rl_admin" checked
                                    type="checkbox" value="1" id="gridCheck1">
                            @else
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                            @endif
                            <label class="form-check-label" for="gridCheck1">
                                Admin
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-warning px-5"
                    id="tombol">submit</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</x-app-layout>
