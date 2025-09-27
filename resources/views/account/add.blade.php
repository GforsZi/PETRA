<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form class="container mt-4" action="/system/account/add" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row g-4 align-items-start">

            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                <img src="{{ asset(Auth::user()->usr_photo_path ?? '/logo/PETRA-LOGO.png') }}"
                    class="rounded-circle shadow object-fit-cover mb-2" alt="Profile Image"
                    width="200" height="200">
                <input type="file" name="image" id="profileImage" class="d-none">
                <a href="#" class="text-decoration-none"
                    onclick="document.getElementById('profileImage').click();">Ubah Foto Profil</a>
            </div>

            <div class="col-12 col-md-8">
                <div class="mb-1">
                    <label for="nama" class="form-label">Nama</label>
                    <input name="name" type="text" id="nama" class="form-control"
                        autocomplete="off">
                </div>

                <div class="mb-1">
                    <label for="whatsapp" class="form-label">No WhatsApp</label>
                    <input name="usr_no_wa" type="text" id="whatsapp" class="form-control">
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" id="password" class="form-control"
                        autocomplete="off">
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" id="password"
                        class="form-control" autocomplete="off">
                </div>
                <div class="options">
                    <p class="text-3 mb-1">Pilih peran</p>

                    <select name="usr_role_id"
                        class="form-select @error('usr_role_id') is-invalid @enderror" required
                        aria-label="Default select example">
                        <option>{{ $account[0]['roles']['rl_name'] ?? 'select role' }}</option>
                        @foreach ($roles as $role)
                            @if ($role['rl_admin'])
                                <option style="color: #E9AD01;" value="{{ $role->rl_id }}">
                                    {{ $role->rl_name }}</option>
                            @else
                                <option value="{{ $role->rl_id }}">{{ $role->rl_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- From Uiverse.io by adamgiebl -->
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-outline-primary w-100">Selesai</button>
                </div>

            </div>
    </form>

</x-app-layout>
