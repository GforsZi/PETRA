<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand text-light text-center d-flex align-items-center" href="#HOME">
                <img src="{{ asset('logo/landing/PETRA-LOGO.png') }}" alt="Logo PETRA" style="height: 40px; width: 35px;">

                <b class="ms-2 fw-bold pt-1">PETRA</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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

        <section class="hero-section view-custom d-flex align-items-center mt-5" id="HOME">
            <div class="container hero-content" data-aos="fade-up-right" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="1200">
                <hr />
                <h1>SELAMAT DATANG</h1>
                <p>membuka jendela dunia, satu buku untuk sejuta ilmu</p>
                <div class="d-flex gap-3 flex-wrap">
                    @auth
                        @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
                            <a class="btn btn-gradient me-1" href="/dashboard">Dashboard</a>
                        @else
                            <a class="btn btn-gradient me-1" href="/home">Home</a>
                        @endif
                    @else
                        <a class="btn btn-outline-primary" href="/register">SIGN-UP</a>
                        <a class="btn btn-gradient" href="/login">SIGN-IN</a>
                    @endauth
                </div>
            </div>
            <div class="gambar z-3" data-aos="fade-down-left" data-aos-duration="1500">
                <!-- From Uiverse.io by eslam-hany -->
                <div class="book">
                    <img src="{{ asset('logo/2.svg') }}" alt="Book">
                    <p class="kata">Bangun masa depanmu dengan selembar buku</p>
                    <h5 class="copy">copyright | Dyons</h5>
                    <div class="cover">
                        <img src="{{ asset('logo/cover.svg') }}" alt="Book Cover">
                    </div>
                </div>
            </div>

            <style>
                .gambar {
                    display: flex;
                    justify-content: center;
                    padding-right: 100px;
                }

                .cover img {
                    object-fit: cover;
                    width: 100%;
                    height: 100%;
                    /* border-radius: 20px; */
                }

                /* From Uiverse.io by eslam-hany */
                .book {
                    position: relative;
                    border-radius: 10px;
                    width: 300px;
                    height: 400px;
                    background-color: whitesmoke;
                    box-shadow: 8px 10px 12px #000;
                    transform: preserve-3d;
                    perspective: 2000px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #000;
                    /* overflow: hidden; */
                }

                .cover {
                    top: 0;
                    position: absolute;
                    background-color: lightgray;
                    width: 100%;
                    height: 100%;
                    /* border-radius: 10px; */
                    cursor: pointer;
                    transition: all 0.5s;
                    transform-origin: 0;
                    box-shadow: 0px 8px 12px #000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    /* border-radius: 10px; */
                    z-index: 2;
                }

                .book:hover .cover {
                    transition: all 0.5s;
                    transform: rotatey(-80deg);
                }

                .cover img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    /* border-radius: 10px; */
                }

                /* Teks utama di dalam buku */
                .book p {
                    position: absolute;
                    top: 25%;
                    /* di atas pohon */
                    left: 50%;
                    transform: translate(-50%, -50%);
                    color: white;
                    font-size: 15px;
                    font-weight: normal;
                    text-shadow: 0 0 8px rgba(0, 0, 0, 0.8);
                    z-index: 1;
                    pointer-events: none;
                    opacity: 0;
                    transition: opacity 0.5s ease;
                    transition-delay: 0s;
                    letter-spacing: 1.5px;
                    text-transform: uppercase;
                    background: linear-gradient(90deg, #ffffff, #b3e5fc, #ffffff);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    text-shadow:
                        0 0 8px rgba(255, 255, 255, 0.7),
                        0 0 15px rgba(173, 216, 230, 0.6),
                        0 0 30px rgba(135, 206, 250, 0.5);
                }

                .book p::after {
                    content: "";
                    position: absolute;
                    left: 50%;
                    bottom: -6px;
                    transform: translateX(-50%);
                    width: 0%;
                    height: 2px;
                    background: linear-gradient(90deg, transparent, #b3e5fc, transparent);
                    border-radius: 2px;
                    transition: width 1s ease;
                    opacity: 0.8;
                }

                .book:hover p::after {
                    width: 80%;
                }

                @keyframes glowPulse {
                    0% {
                        text-shadow:
                            0 0 8px rgba(255, 255, 255, 0.6),
                            0 0 15px rgba(173, 216, 230, 0.5),
                            0 0 30px rgba(135, 206, 250, 0.4);
                    }

                    50% {
                        text-shadow:
                            0 0 12px rgba(255, 255, 255, 0.9),
                            0 0 25px rgba(173, 216, 230, 0.8),
                            0 0 45px rgba(135, 206, 250, 0.6);
                    }

                    100% {
                        text-shadow:
                            0 0 8px rgba(255, 255, 255, 0.6),
                            0 0 15px rgba(173, 216, 230, 0.5),
                            0 0 30px rgba(135, 206, 250, 0.4);
                    }
                }

                .book:hover p {
                    animation: glowPulse 3s ease-in-out infinite;
                    z-index: 3;
                    opacity: 1;
                    transition-delay: 0.5s;
                }

                /* 🔹 Gaya dan posisi untuk copyright */
                .book h5.copy {
                    position: absolute;
                    bottom: 5%;
                    /* di bagian paling bawah gambar 2.svg */
                    left: 50%;
                    transform: translateX(-50%);
                    font-size: 13px;
                    font-weight: normal;
                    text-transform: uppercase;
                    background: linear-gradient(90deg, #ffffff, #b3e5fc, #ffffff);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    text-shadow:
                        0 0 8px rgba(255, 255, 255, 0.7),
                        0 0 15px rgba(173, 216, 230, 0.6),
                        0 0 30px rgba(135, 206, 250, 0.5);
                    opacity: 0;
                    transition: opacity 0.5s ease;
                    transition-delay: 0s;
                    pointer-events: none;
                }

                .book:hover h5.copy {
                    opacity: 1;
                    animation: glowPulse 3s ease-in-out infinite;
                    transition-delay: 0.5s;
                }
            </style>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
                    const navbarCollapse = document.getElementById('navbarNav');

                    navLinks.forEach(link => {
                        link.addEventListener('click', () => {
                            // Tutup menu setelah klik link
                            if (navbarCollapse.classList.contains('show')) {
                                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                                bsCollapse.hide();
                            }
                        });
                    });
                });

                // book
                const quotesMain = [
                    "Bangun masa depanmu dengan selembar buku",
                    "Buku adalah jendela menuju kebijaksanaan",
                    "Membaca hari ini, memimpin esok",
                    "Isi harimu dengan ilmu, bukan kebingungan",
                    "Satu buku bisa mengubah hidupmu",
                    "Temukan dunia baru di setiap halaman",
                    "Ilmu datang dari membaca, bukan menunggu",
                    "Buku teman terbaik tanpa syarat",
                    "Membaca adalah investasi seumur hidup",
                    "Buka buku, buka pikiranmu"
                ];

                const quotesCopy = [
                    "© Dyons | Jadikan membaca sebagai kebiasaan",
                    "© Dyons | Cinta buku, cinta ilmu",
                    "© Dyons | Buku: sahabat sepanjang masa",
                    "© Dyons | Hidupkan pikiranmu lewat membaca",
                    "© Dyons | Setiap halaman adalah pelajaran",
                    "© Dyons | Bacalah dan temukan dirimu",
                    "© Dyons | Pengetahuan dimulai dari buku",
                    "© Dyons | Buku tak pernah mengkhianati pembacanya",
                    "© Dyons | Jadilah bijak dengan membaca",
                    "© Dyons | Membaca, langkah kecil menuju besar"
                ];

                // Ambil elemen p dan h5
                const kataEl = document.querySelector(".kata");
                const copyEl = document.querySelector(".copy");

                // Pilih acak tiap refresh
                kataEl.textContent = quotesMain[Math.floor(Math.random() * quotesMain.length)];
                copyEl.textContent = quotesCopy[Math.floor(Math.random() * quotesCopy.length)];
            </script>

        </section>
    </div>
    <section id="about" class="mb-5" data-aos="zoom-out" data-aos-duration="1500">
        <div class="container about-custom">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">TENTANG KAMI</h2>
                    <p>
                        Kami berkomitmen untuk membuka akses pengetahuan seluas mungkin. Dengan satu buku, kami
                        percaya setiap orang bisa menemukan sejuta ilmu yang bermanfaat untuk hidup dan masa depan.
                    </p>
                </div>

                <div class="col-md-4 d-flex justify-content-end d-none d-md-flex">
                    <div class="newtonsCradle">
                        <div class="frameCover"></div>
                        <div class="frame">
                            <div class="sphere-wrap left">
                                <div class="string string-left"></div>
                                <div class="sphere"></div>
                            </div>
                            <div class="sphere center"></div>
                            <div class="sphere center"></div>
                            <div class="sphere center"></div>
                            <div class="sphere-wrap right">
                                <div class="string string-right"></div>
                                <div class="sphere"></div>
                            </div>
                        </div>
                        <div class="base"></div>
                    </div>
                </div>

    </section>

    </section>

    <!-- Keunggulan Kami -->
    <section class="mt-4" id="keunggulan">

        <h1 class="text-center mb-4 text-uppercase text-bold " data-aos="fade-down" data-aos-duration="1500">Keunggulan Kami</h1>

        <div class="section-flex">

            <!-- Gambar -->
            <div class="foto" data-aos="fade-down-right" data-aos-duration="1500">
                <img src="{{ asset('logo/landing/perpus.jpg') }}" alt="Perpustakaan">
            </div>

            <!-- Card -->
            <div class="cards">
                <div class="card red" data-aos="fade-left" data-aos-duration="1500">

                    <p class="tip">Antarmuka yang Sederhana dan Interaktif</p>
                </div>
                <div class="card blue" data-aos="fade-left" data-aos-duration="1500">

                    <p class="tip">Notifikasi & Pengingat Otomatis</p>
                </div>
                <div class="card green" data-aos="fade-left" data-aos-duration="1500">

                    <p class="tip">Pelayanan cepat </p>
                </div>
            </div>

        </div>

    </section>
    <footer class="footer text-white" id="Kontak">
        <div class="container py-4" style="height : 85vh">
            <div class="row align-items-start">

                <footer class="container-fluid py-4">
                    <div class="row align-items-center">
                        <footer class="container-fluid py-4">
                            <div class="row align-items-center">

                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">

                                    <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                                        <img src="{{ asset('logo/landing/PETRA-LOGO.png') }}" alt="Logo Petra" style="width: 50px; height: 65px;">
                                        <h3 class="mb-0 text-uppercase">PETRA</h3>
                                    </div>

                                    <div class="d-flex align-items-center gap-3 text-center text-md-end">
                                        <div>
                                            <p class="mb-1 fw-semibold">2025 Copyright | WPMP</p>
                                            <p class="mb-0">
                                                <i class="bi bi-geo-alt-fill me-1"></i> SMK Mahaputra
                                            </p>
                                        </div>
                                        <img src="{{ asset('logo/landing/Mahaputra.jpeg') }}" alt="Logo Mahaputra" style="width: 50px; height: 50px;" class="rounded-circle">
                                    </div>

                                </div>

                        </footer>

                        <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                            <!-- From Uiverse.io by javierBarroso -->
                            <div class="social-login-icons">
                                <div class="socialcontainer">
                                    <div class="icon social-icon-2-2">

                                        <i class="bi bi-instagram"></i>
                                    </div>
                                    <a href="https://www.instagram.com/smkmahaputra_official?igsh=MTUyZW43NWMwNW1sMw==" class="text-light">

                                        <div class="social-icon-2">
                                            <i class="bi bi-instagram"></i>

                                        </div>
                                    </a>
                                </div>
                                <div class="socialcontainer">
                                    <div class="icon social-icon-3-3">
                                        <i class="bi bi-globe"></i>
                                    </div>
                                    <a href="https://www.smkmahaputra.sch.id" class="text-light" target="_blank" rel="noopener noreferrer">
                                        <div class="social-icon-3">
                                            <i class="bi bi-globe"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="socialcontainer">
                                    <div class="icon social-icon-4-4">
                                        <i class="bi bi-tiktok"></i>

                                    </div>
                                    <a href="https://www.tiktok.com/@smkmahaputra_official?_t=ZS-90ER2mFsQ5q&_r=1" class="text-light">
                                        <div class="social-icon-4">

                                            <i class="bi bi-tiktok"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.09561724186!2d107.576833774542!3d-6.998020368538179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9681a28859f%3A0x48f4d9cf5a8ab783!2sSMKS%20Mahaputra%20Cerdas%20Utama!5e0!3m2!1sid!2sid!4v1757997057212!5m2!1sid!2sid"
                                width="100%" height="250" style="border:0; border-radius: 8px; margin-top: 60px;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
            </div>
    </footer>
</x-guest-layout>
