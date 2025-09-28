<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Ubah Opsi</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form action="/system/option/{{ $option['cht_opt_id'] }}/edit" method="post">
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Judul opsi</label>
                    <div class="col-sm-10">
                        <input type="text" name="cht_opt_title"
                            value="{{ $option['cht_opt_title'] }}"
                            class="form-control @error('cht_opt_title') is-invalid @enderror"
                            id="inputEmail3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Pesan opsi</label>
                    <div class="col-sm-10">
                        <textarea name="cht_opt_message" class="form-control @error('cht_opt_message') is-invalid @enderror"
                            id="autoExpand">{{ $option['cht_opt_message'] }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="type" class="col-sm-2 col-form-label">Tipe Pesan</label>
                    <div class="col-sm-10">
                        <select name="cht_opt_type"
                            class="form-select @error('cht_opt_type') is-invalid @enderror" required
                            aria-label="Default select example" id="type">
                            @if ($option['cht_opt_type'] == '1')
                                <option value="1" selected>Pemberitahuan aktifasi</option>
                                <option value="2">Peringatan waktu peminjaman</option>
                                <option value="3">Pesan bantuan</option>
                            @elseif ($option['cht_opt_type'] == '2')
                                <option value="1">Pemberitahuan aktifasi</option>
                                <option value="2" selected>Peringatan waktu peminjaman</option>
                                <option value="3">Pesan bantuan</option>
                            @else
                                <option value="1">Pemberitahuan aktifasi</option>
                                <option value="2">Peringatan waktu peminjaman</option>
                                <option value="3" selected>Pesan bantuan</option>
                            @endif

                        </select>
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
