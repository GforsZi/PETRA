<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/landing.css') }}">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/logo/landing/PETRA-LOGO.png') }}" alt="Logo PETRA"
                    style="height: 40px; width: 35px;">
            </a>
            <button class="navbar-toggler btn-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="background-color: white;"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#HOME">HOME</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link active fw-bold" href="#about">ABOUT</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#keunggulan">Keunggulan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#Contak">Contact</a>
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
    <footer class="footer text-white">
        <div class="container py-4">
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
                                    <svg fill="white" class="svgIcon" viewBox="0 0 448 512"
                                        height="1.5em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="social-icon-2">
                                    <svg fill="white" class="svgIcon" viewBox="0 0 448 512"
                                        height="1.5em" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="socialcontainer">
                                <div class="icon social-icon-3-3">
                                    <svg viewBox="0 0 384 512" fill="white" height="1.6em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="social-icon-3">
                                    <svg viewBox="0 0 384 512" fill="white" height="1.6em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="socialcontainer">
                                <div class="icon social-icon-4-4">

                                    <svg fill="white" viewBox="0 0 448 512" height="1.6em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M448,209.9v127.7c-25.4,0-50.2-4.9-73.1-14.6v91.6
          c0,53.1-43.1,96.2-96.2,96.2H170.5c-53.1,0-96.2-43.1-96.2-96.2
          s43.1-96.2,96.2-96.2c5.5,0,10.9,0.5,16.1,1.4v66.9
          c-5.2-1.6-10.6-2.5-16.1-2.5c-26.6,0-48.1,21.6-48.1,48.1
          s21.6,48.1,48.1,48.1s48.1-21.6,48.1-48.1V48h79.9
          c0,53.2,43.1,96.3,96.3,96.3v65.6c-19.6-9-38.2-21.3-54.8-36.2v36.2
          C386.3,209.9,416.4,209.9,448,209.9z" />
                                    </svg>
                                </div>
                                <div class="social-icon-4">
                                    <svg fill="white" viewBox="0 0 448 512" height="1.6em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M448,209.9v127.7c-25.4,0-50.2-4.9-73.1-14.6v91.6
          c0,53.1-43.1,96.2-96.2,96.2H170.5c-53.1,0-96.2-43.1-96.2-96.2
          s43.1-96.2,96.2-96.2c5.5,0,10.9,0.5,16.1,1.4v66.9
          c-5.2-1.6-10.6-2.5-16.1-2.5c-26.6,0-48.1,21.6-48.1,48.1
          s21.6,48.1,48.1,48.1s48.1-21.6,48.1-48.1V48h79.9
          c0,53.2,43.1,96.3,96.3,96.3v65.6c-19.6-9-38.2-21.3-54.8-36.2v36.2
          C386.3,209.9,416.4,209.9,448,209.9z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Kanan atas: Teks copyright dan lokasi -->
                <div class="col-md-8 text-center text-md-end">
                    <p class="mb-1 fw-semibold">2025 Copyright | WPMP</p>
                    <p class="mb-3">
                        <i class='bxr  bxs-location'></i> SMSK Mahaputra
                    </p>
                </div>

            </div>

            <!-- Baris bawah: MAP -->
            <div class="row mt-3">
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.09561724186!2d107.576833774542!3d-6.998020368538179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9681a28859f%3A0x48f4d9cf5a8ab783!2sSMKS%20Mahaputra%20Cerdas%20Utama!5e0!3m2!1sid!2sid!4v1757997057212!5m2!1sid!2sid"
                        width="100%" height="250" style="border:0; border-radius: 8px;"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </footer>
</x-guest-layout>
