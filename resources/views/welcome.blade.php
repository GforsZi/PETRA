<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landing.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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

        <section class="hero-section view-custom d-flex align-items-center mt-5 " id="HOME">
            <div class="container hero-content" data-aos="fade-up" data-aos-anchor="#example-anchor" data-aos-offset="500" data-aos-duration="1200">
                <hr />
                <h1>SELAMAT DATANG</h1>
                <p>membuka jendela dunia, satu buku untuk sejuta ilmu</p>
                <div class="d-flex gap-3 flex-wrap">
                    @auth
                        @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
                            <a class="btn btn-gradient me-1" href="/dashboard">Dasbor</a>
                        @else
                            <a class="btn btn-gradient me-1" href="/home">Beranda</a>
                        @endif
                    @else
                        <a class="btn btn-outline-primary" href="/register">Daftar</a>
                        <a class="btn btn-gradient" href="/login">Masuk</a>
                    @endauth
                </div>
            </div>

            <div class="gambar z-3 " data-aos="fade-up" data-aos-duration="1500">
                <!-- From Uiverse.io by eslam-hany -->
                <div class="book">
                    <img src="{{ asset('logo/air.jpg') }}" alt="Book">
                    <p class="kata">Bangun masa depanmu dengan selembar buku</p>
                    <h5 class="copy">copyright | Dyons</h5>
                    <div class="cover">
                        <img src="{{ asset('logo/terjun.jpg') }}" alt="Book Cover">
                    </div>
                </div>
            </div>

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
                
                const quotes = [{
                        text: "Padi tumbuh tidak berisik.",
                        author: "Tan Malaka"
                    },
                    {
                        text: "Di depan memberi teladan, di tengah membangun semangat, di belakang memberi dorongan.",
                        author: "Ki Hajar Dewantara"
                    },
                    {
                        text: "Ilmu tanpa agama adalah buta, agama tanpa ilmu adalah lumpuh.",
                        author: "BJ.Habibi"
                    },
                    {
                        text: "Habis gelap terbitlah terang.",
                        author: "R.A. Kartini"
                    },
                    {
                        text: "Ilmu tanpa akhlak akan menyesatkan.",
                        author: "Imam Al-Ghazali"
                    },
                    {
                        text: "Rasa ingin tahu adalah guru terbaik.",
                        author: "Albert Einstein"
                    },
                    {
                        text: "Pendidikan bukan persiapan untuk hidup; pendidikan itu sendiri adalah kehidupan.",
                        author: "John Dewey"
                    },
                    {
                        text: "Keberhasilan berasal dari 1% inspirasi dan 99% kerja keras.",
                        author: "Thomas A. Edison"
                    },
                    {
                        text: "Pendidikan bukan hanya tentang membaca dan menulis, tapi tentang membangun peradaban.",
                        author: "Anies Baswedan"
                    },
                    {
                        text: "Jika engkau tidak sanggup menanggung lelahnya belajar, maka engkau harus menanggung pedihnya kebodohan.",
                        author: " Imam Asy-Syafi’i"
                    }
                ];

                // Ambil elemen teks di HTML kamu
                const kataEl = document.querySelector(".kata");
                const copyEl = document.querySelector(".copy");

                // Pilih 1 pasangan acak setiap refresh
                const randomIndex = Math.floor(Math.random() * quotes.length);
                const quote = quotes[randomIndex];

                // Tampilkan hasilnya
                kataEl.textContent = quote.text;
                copyEl.textContent = quote.author;
            </script>

        </section>
    </div>
    <section id="about" class="mb-5" data-aos="fade-up" data-aos-duration="1500">
        <div class="container about-custom">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">TENTANG KAMI</h2>
                    <p class="fs-4">
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
            </div>
        </div>
    </section>

    </section>

    <!-- Keunggulan Kami -->
    <section class="mt-4" id="keunggulan">

        <h1 class="text-center mb-4 text-uppercase  fw-bold " data-aos="fade-up" data-aos-duration="1500">Keunggulan Kami</h1>

        <div class="section-flex">

            <!-- Gambar -->
            <div class="foto text-center" data-aos="fade-up" data-aos-duration="1500">
                <img src="{{ asset('logo/landing/ilustrasi.JPG') }}" alt="Perpustakaan" class="img-fluid rounded foto-img">
            </div>

            <style>
                .foto {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .foto-img {
                    width: auto;
                    max-width: 100%;
                    height: auto;
                    object-fit: contain;
                }

                @media (max-width: 898px) {
                    .foto-img {
                        width: 80%;
                    }
                }

                @media (max-width: 576px) {
                    .foto-img {
                        width: 90%;
                    }
                }

                 h1 {
      font-family: 'Roboto', sans-serif;
      font-weight: 700;
    }
    p {
      font-family: 'Roboto', sans-serif;
      font-weight: 400;
    }
            </style>

            <!-- Card -->
            <div class="cards">
                <div class="card red" data-aos="fade-up" data-aos-duration="1500">

                    <p class="tip fs-5">Antarmuka yang Sederhana dan Interaktif</p>
                </div>
                <div class="card blue" data-aos="fade-up" data-aos-duration="1500">

                    <p class="tip fs-5">Notifikasi & Pengingat Otomatis</p>
                </div>
                <div class="card green" data-aos="fade-up" data-aos-duration="1500">

                    <p class="tip fs-5">Pelayanan cepat </p>
                </div>
            </div>

        </div>

    </section>
<footer class="footer text-white" id="Kontak">
  <div class="container" style="height: 100vh;">
    <div class="row align-items-start">
      <footer class="container-fluid mt-5">
        <div class="row align-items-center">
          <footer class="container-fluid">
            <div class="row align-items-center">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2 mb-3 mb-md-0">
                  <img src="{{ asset('logo/landing/PETRA-LOGO.png') }}" alt="Logo Petra" style="width: 50px; height: 65px;">
                  <h3 class="mb-0 text-uppercase">PETRA</h3>
                </div>

                <div class="d-flex align-items-center gap-3 text-center text-md-end">
                  <div>
                    <p class="mb-1 fw-semibold">2025 Copyright | WPMP</p>
                    <p class="mb-0"><i class="bi bi-geo-alt-fill me-1"></i> SMK Mahaputra</p>
                  </div>
                  <img src="{{ asset('logo/landing/Mahaputra.jpeg') }}" alt="Logo Mahaputra" style="width: 50px; height: 50px;" class="rounded-circle">
                </div>
              </div>
            </div>
          </footer>
        </div>
      </footer>

      <div class="d-flex gap-3 justify-content-center justify-content-md-start">
        <div class="social-login-icons">
          <div class="socialcontainer">
            <div class="icon social-icon-2-2"><i class="bi bi-instagram"></i></div>
            <a href="https://www.instagram.com/smkmahaputra_official?igsh=MTUyZW43NWMwNW1sMw==" class="text-light">
              <div class="social-icon-2"><i class="bi bi-instagram"></i></div>
            </a>
          </div>

          <div class="socialcontainer">
            <div class="icon social-icon-3-3"><i class="bi bi-globe"></i></div>
            <a href="https://www.smkmahaputra.sch.id" class="text-light" target="_blank">
              <div class="social-icon-3"><i class="bi bi-globe"></i></div>
            </a>
          </div>

          <div class="socialcontainer">
            <div class="icon social-icon-4-4"><i class="bi bi-tiktok"></i></div>
            <a href="https://www.tiktok.com/@smkmahaputra_official?_t=ZS-90ER2mFsQ5q&_r=1" class="text-light">
              <div class="social-icon-4"><i class="bi bi-tiktok"></i></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 🔹 pattern square di bawah banget -->
  <div class="pattern-square"></div>
</footer>

</footer>

<style>
 footer .pattern-square {
  position: absolute;
  inset: auto 0 0 0;
  width: 100%;
  height: 48%; /* sedikit lebih tinggi biar ruangnya cukup */
  z-index: 1;
  opacity: 0.9;
  pointer-events: none;
  background-color: #121740;

  /* 🎨 SVG diamond pattern */
  background-image: url("data:image/svg+xml;utf8,\
  <svg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewBox='0 0 64 64'>\
    <rect width='100%' height='100%' fill='%23121740'/>\
    <!-- ruang kosong di atas (padding visual) -->\
    <rect y='-4' width='64' height='8' fill='%23121740'/>\
    <!-- diamond shapes -->\
    <path d='M32 0 L64 32 L32 64 L0 32 Z' fill='none' stroke='%23100f0f' stroke-width='1.5'/>\
    <path d='M32 8 L56 32 L32 56 L8 32 Z' fill='none' stroke='%23100f0f' stroke-width='1.2'/>\
    <path d='M32 16 L48 32 L32 48 L16 32 Z' fill='none' stroke='%23100f0f' stroke-width='1'/>\
  </svg>");

  background-size: 64px 64px;
  background-repeat: repeat;
  background-position: center bottom; /* fokus di bawah biar garis atas gak kelihatan */
 
}


}

</style>


    

   
</x-guest-layout>
