<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/register.css') }}">
    <div class="row g-0" style="height: 100vh;">
        <!-- Gambar-->
        <div class="col-8 p-0">
            <img src="{{ asset('logo/relog/book.png') }}" alt="Perpustakaan"
                style="width: 100%; height: 100vh; object-fit: cover;">
        </div>

        <!-- Form  -->
        <div class="col-4 p-0">
            <div class="d-flex flex-column justify-content-center align-items-center text-white"
                style="height: 100vh; width: 100%; background-color: #121740;">

                <div class="w-100 px-5">
                    <p class="text-center fs-2 fw-bold mb-4">Register</p>

                    <div class="text-center mb-4">
                        <img src="{{ asset('logo/PETRA-LOGO.png') }}" class="img-fluid"
                            style="width: 150px; height: 150px; object-fit: contain;">
                    </div>
                    <div class="bar">
                        <form action="/system/register" method="post">
                            @csrf
                            <input name="name" type="text" class="form-control mb-3"
                                placeholder="Input username">
                            <input name="usr_no_wa" type="text" class="form-control mb-4"
                                placeholder="No.Telp">
                            <input name="password" type="password" class="form-control mb-4"
                                placeholder="Password">
                            <input name="password_confirmation" type="password"
                                class="form-control mb-4" placeholder="Konfirmasi Password">
                    </div>
                    <button type="submit" class="control">Kirim</button>
                    </form>

                    <p class="text-center">
                        Belum memiliki akun sebelumnya?
                        <a href="/login" class="text-decoration-none text-success">Login</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
