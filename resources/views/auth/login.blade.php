<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    <div class="row g-0" style="height: 100vh;">
        <!-- Gambar-->
        <div class="col-8 p-0">
            <img src="{{ asset('logo/login.JPG') }}" alt="Perpustakaan" style="width: 100%; height: 100vh; object-fit: cover;">
        </div>

        <!-- Form  -->
        <div class="col-4 p-0">
            <div class="d-flex flex-column justify-content-center align-items-center text-white" style="height: 100vh; width: 100%; background-color: #121740;">

                <div class="w-100 px-5">
                    <p class="text-center fs-2 fw-bold mb-4">Masukan akun</p>

                    <div class="text-center mb-4">
                        <img src="{{ asset('logo/PETRA-LOGO.png') }}" class=" img-fluid" style="width: 150px; height: 150px; object-fit: contain;">
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h5>{{ session('success') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5>{{ session('error') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="bar">
                        <form action="/system/login" method="post">
                            @csrf
                            <input value="{{ old('usr_no_wa') }}" name="usr_no_wa" type="text" class="form-control mb-3" placeholder="Nomor WhatsApp">
                            <input name="password" type="password" class="form-control mb-4" placeholder="Kata sandi">
                    </div>
                    <button type="submit" class="control" onclick="this.disabled=true; this.form.submit();">Kirim</button>
                    </form>

                    <p class="text-center">
                        Belum memiliki akun sebelumnya?
                        <a href="/register" class="text-decoration-none text-success">Daftar akun</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
