<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}">
    <div class="row g-0" style="height: 100vh;">
        <!-- Gambar-->
        <div class="col-8 p-0">
            <img src="{{ asset('logo/regis.JPG') }}" alt="Perpustakaan" style="width: 100%; height: 100vh; object-fit: cover;">
        </div>

        <!-- Form  -->
        <div class="col-4 p-0">
            <div class="d-flex flex-column justify-content-center align-items-center text-white" style="height: 100vh; width: 100%; background-color: #121740;">

                <div class="w-100 px-5">
                    <p class="text-center fs-2 fw-bold mb-4">Pendaftaran akun</p>

                    <div class="text-center mb-4">
                        <img src="{{ asset('logo/PETRA-LOGO.png') }}" class="img-fluid" style="width: 150px; height: 150px; object-fit: contain;">
                    </div>
                    <div class="bar">
                        <form action="/system/register" method="post">
                            @csrf

                            <input name="name" type="text" class="form-control mb-1" placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger" style="text-align: right;">Nama pengguna wajib diisi</p>
                            @enderror

                            <input name="usr_no_wa" type="text" class="form-control mt-3 mb-1" placeholder="Nomor WhatsApp" value="{{ old('usr_no_wa') }}">
                            @error('usr_no_wa')
                                <small class="invalid-feedback">
                                    @if (old('usr_no_wa'))
                                        <p class="text-danger" style="text-align: right;">Nomor yang anda isi sudah terpakai atau tidak sesuai: {{ old('usr_no_wa') }}</p>
                                    @endif
                                </small>
                            @enderror

                            <input name="password" type="password" class="form-control mt-3 mb-1" placeholder="Kata Sandi">
                            @error('password')
                                <p class="text-danger" style="text-align: right;">Kata sandi minimal 5 karakter.</p>
                            @enderror

                            <input name="password_confirmation" type="password" class="form-control mt-3 mb-1" placeholder="Ulangi Kata Sandi">
                            @error('password_confirmation')
                                <p class="text-danger" style="text-align: right;">Konfirmasi kata sandi tidak sesuai.</p>
                            @enderror

                            <button type="submit" class="control mt-4" onclick="this.disabled=true; this.form.submit();">Daftar</button>
                        </form>

                        <p class="text-center">
                            Sudah memiliki akun sebelumnya?
                            <a href="/login" class="text-decoration-none text-success">Masuk</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
</x-guest-layout>
