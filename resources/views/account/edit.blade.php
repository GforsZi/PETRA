<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form class="container mt-4" action="/system/account/{{ $account[0]['usr_id'] }}/edit" method="post">
        @csrf
        @method('PUT')
        <div class="row g-4 align-items-start">

            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                <img src="{{ asset($account[0]['usr_card_url'] ?? '/logo/user_placeholder.jpg') }}" class="rounded-circle shadow object-fit-cover mb-2" alt="Profile Image" width="200" height="200">
            </div>

            <div class="col-12 col-md-8">
                <div class="mb-1">
                    <label for="nama" class="form-label " data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Nama</label>
                    <input name="name" type="text" id="nama" value="{{ $account[0]['name'] }}" class="form-control  shadow object-fit-cover @error('name') is-invalid @enderror"
                        autocomplete="off">
                    @error('name')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Input tidak sesuai</p>
                        </div>
                    @enderror
                </div>

                <div class="mb-1">
                    <label for="whatsapp" class="form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">No
                        WhatsApp</label>
                    <input name="usr_no_wa" type="text" id="whatsapp" value="{{ $account[0]['usr_no_wa'] }}" class="form-control  shadow object-fit-cover @error('usr_no_wa') is-invalid @enderror">
                    @error('usr_no_wa')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Input tidak sesuai </p>
                        </div>
                    @enderror
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Password</label>
                    <input name="password" type="password" id="password" class="form-control  shadow object-fit-cover @error('password') is-invalid @enderror " autocomplete="off">
                    @error('password')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Input tidak sesuai</p>
                        </div>
                    @enderror
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">Konfirmasi
                        Password</label>
                    <input name="password_confirmation" type="password" id="password" class="form-control  shadow object-fit-cover " autocomplete="off">
                </div>
                <div class="options">
                    <p class="text-3 mb-1" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-title="Pemberitahuan"
                        data-bs-content="Memilih jurusan akan membuat buku ini dimasukan dalam kategori buku paket pembelajaran">
                        Pilih peran</p>

                    <select name="usr_role_id" class="form-select @error('usr_role_id') is-invalid @enderror" required aria-label="Default select example">
                        <option selected>
                            {{ $account[0]['roles']['rl_name'] ?? 'select role' }}</option>
                        @foreach ($roles as $role)
                            @if ($role['rl_admin'])
                                <option style="color: #E9AD01;" value="{{ $role->rl_id }}">
                                    {{ $role->rl_name }}</option>
                            @else
                                <option value="{{ $role->rl_id }}">{{ $role->rl_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('usr_role_id')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Tolong pilih salah satu</p>
                        </div>
                    @enderror
                </div>

                <!-- From Uiverse.io by adamgiebl -->
                <div class="d-flex justify-content-center mt-5">

                    <button type="submit" class="btn btn-outline-warning w-100" onclick="this.disabled=true; this.form.submit();">Selesai</button>

                </div>

            </div>
    </form>

</x-app-layout>
