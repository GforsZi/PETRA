<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/landing.css') }}">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand text-light text-center d-flex align-items-center" href="#HOME">
                <img src="{{ asset('/logo/landing/PETRA-LOGO.png') }}" alt="Logo PETRA"
                    style="height: 40px; width: 35px;">

                <b class="ms-2 fw-bold pt-1">PETRA</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link active fw-bold" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#keunggulan">Keunggulan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#Kontak">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->

    <div class="view">

        <section class="hero-section d-flex align-items-center" id="HOME">
            <div class="container hero-content">
                <hr />
                <h1>SELAMAT DATANG</h1>
                <p>membuka jendela dunia, satu buku untuk sejuta ilmu</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a class="btn btn-outline-primary" href="/register">SIGN-UP</a>
                    <a class="btn btn-gradient" href="/login">SIGN-IN</a>
                </div>
            </div>
            <div class="gambar z-3">
                <img src="{{ asset('/logo/landing/lorem.png') }}" alt="book cover"
                    style="height: 10%;">
            </div>
        </section>

    </div>
    <!-- Tentang Kami -->
    <section id="about">
        <h2>TENTANG KAMI</h2>
        <p>
            Kami berkomitmen untuk membuka akses pengetahuan seluas mungkin. Dengan satu buku, kami
            percaya setiap orang bisa menemukan sejuta ilmu yang bermanfaat untuk hidup dan masa
            depan.
        </p>
    </section>

    <!-- Keunggulan Kami -->
    <section id="keunggulan">

        <h1 class="text-center mb-4 text-uppercase text-bold ">Keunggulan Kami</h1>

        <div class="section-flex">

            <!-- Gambar -->
            <div class="foto">
                <img src="{{ asset('logo/landing/perpus.jpg') }}" alt="Perpustakaan">
            </div>

            <!-- Card -->
            <div class="cards">
                <div class="card red">

                    <p class="tip">Antarmuka yang Sederhana dan Interaktif</p>
                </div>
                <div class="card blue">

                    <p class="tip">Notifikasi & Pengingat Otomatis</p>
                </div>
                <div class="card green">

                    <p class="tip">Pelayanan cepat </p>
                </div>
            </div>

        </div>

    </section>
    <footer class="footer text-white" id="Kontak">
        <div class="container py-4" style="height : 85vh">
            <div class="row align-items-start">

                <!-- Kiri: Logo dan Sosial Media -->
                <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <div
                        class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-3">
                        <img src="{{ asset('/logo/landing/PETRA-LOGO.png') }}" alt="Logo Petra"
                            style="width: 50px; height: 65px;">
                        <h3 class="mb-0 text-uppercase">PETRA</h3>
                    </div>
                    <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                        <!-- From Uiverse.io by javierBarroso -->
                        <div class="social-login-icons">
                            <!-- <div class="socialcontainer">
    <div class="icon social-icon-1-1">
      <svg
        viewBox="0 0 512 512"
        height="1.7em"
        xmlns="http://www.w3.org/2000/svg"
        class="svgIcontwit"
        fill="white"
      >
        <path
          d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"
        ></path>
      </svg>
    </div>
    <div class="social-icon-1">
      <svg
        viewBox="0 0 512 512"
        height="1.7em"
        xmlns="http://www.w3.org/2000/svg"
        class="svgIcontwit"
        fill="white"
      >
        <path
          d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"
        ></path>
      </svg>
    </div>
  </div> -->
                            <div class="socialcontainer">
                                <div class="icon social-icon-2-2">

                                    <i class="bi bi-instagram"></i>
                                </div>
                                <a href="#" class="text-light">

                                    <div class="social-icon-2">
                                        <i class="bi bi-instagram"></i>

                                    </div>
                                </a>
                            </div>
                            <div class="socialcontainer">
                                <div class="icon social-icon-3-3">

                                    <i class="bi bi-facebook"></i>
                                </div>
                                <a href="#" class="text-light">

                                    <div class="social-icon-3">
                                        <i class="bi bi-facebook"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="socialcontainer">
                                <div class="icon social-icon-4-4">
                                    <i class="bi bi-tiktok"></i>

                                </div>
                                <a href="#" class="text-light">
                                    <div class="social-icon-4">

                                        <i class="bi bi-tiktok"></i>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Kanan atas: Teks copyright dan lokasi -->
                <div class="col-md-8 text-center text-md-end">
                    <p class="mb-1 fw-semibold">2025 Copyright | WPMP</p>
                    <p class="mb-3">
                        <i class="bi bi-geo-alt-fill"></i> SMSK Mahaputra
                    </p>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.09561724186!2d107.576833774542!3d-6.998020368538179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9681a28859f%3A0x48f4d9cf5a8ab783!2sSMKS%20Mahaputra%20Cerdas%20Utama!5e0!3m2!1sid!2sid!4v1757997057212!5m2!1sid!2sid"
                        width="100%" height="250" style="border:0; border-radius: 8px; margin-top: 60px;"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </footer>
</x-guest-layout>
