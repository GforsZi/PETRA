<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/adminlte.min.css') }}">
    <x-navbar></x-navbar>

    <main class="app-main bg-body" style="height: 100vh;">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end"></ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Forbidden Section -->
        <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
            <h1 class="display-1 fw-bold text-neon" style="color:#1800ecff; text-shadow:0 0 20px #1800ecff;">403</h1>
            <br>
            <h4 class="fw-semibold mb-3 text-body-emphasis">🚫 Oops! Sepertinya akun kamu belum siap mengakses PETRA</h4>
            <p class="text-body-secondary">
                Admin mungkin belum memberikan hak akses atau aktivasi akunmu masih dalam proses.<br>
                Silakan hubungi admin untuk memastikan status akunmu.
            </p>

            <div class="mt-4 d-flex gap-2">
                <a href="/" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </main>

    <x-footer></x-footer>

    <script src="{{ asset('/js/adminlte.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
</x-guest-layout>
