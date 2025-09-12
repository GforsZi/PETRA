<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <header class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <!-- Logo -->
            <a href="/" class="logo d-flex align-items-center order-1">
                <h1 class="sitename mb-0">UNI-INVT<span>.</span></h1>
            </a>

            <!-- Tombol Login/Register -->
            <div class="auth-buttons d-flex order-2 ms-auto">
                @auth
                    @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
                        <a class="btn-getstarted me-1" href="/dashboard">Already login</a>
                    @else
                        <a class="btn-getstarted me-1" href="/home">Already login</a>
                    @endif
                @else
                    <a class="btn-getstarted me-0" href="/login">Login</a>
                    <a class="btn-getstarted ms-1" href="/register">Register</a>
                @endauth
            </div>

        </div>
    </header>

    <style>
        .Motto {
            color: white;
        }

        .Motto:hover {
            color: #F3C623;
        }

        body {
            background-color: black;
        }

        .visi-misi-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
        }

        .visi-misi-card:hover {
            border-color: #F3C623;
            color: #F3C623;
            box-shadow: 0 0 20px rgba(243, 198, 35, 0.6);
        }

        .text-justify {
            text-align: justify;
        }

        .animate__zoomInDown {
            display: inline-block;
            margin: 0 0.5rem;
            animation: zoomInDown;
            animation-duration: 7s;
        }
    </style>
    </header>
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

            <div class="container">

                <div class="row justify-content-center text-center" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="col-xl-6 col-lg-8">
                        <h2> 𝙂𝙁𝙊𝙍𝙎 𝒞𝒪𝑅𝒫 <span></span></h2>
                        <a href="#" class="Motto">Berkembang secepat cahaya</a>
                        <!-- <p>Berkembang secepat cahaya</p> -->
                    </div>
                </div>

                <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class='bxr  bxs-like' style="font-size: 70px;"></i>
                            <h3><a href="">Terpercaya</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            {{-- <i class="bi bi-bullseye"></i> --}}
                            <i class='bxr bxs-form' style="font-size: 70px;"></i>

                            <h3><a href="">Tersusun rapih</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            {{-- <i class="bi bi-fullscreen-exit"></i> --}}
                            <i class='bxr  bxs-alarm' style="font-size: 70px;"></i>
                            <h3><a href="">Layanan Cepat</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="icon-box">
                            {{-- <i class="bi bi-card-list"></i> --}}
                            <i class='bxr  bxs-blocks' style="font-size: 70px;"></i>
                            <h3><a href="">Fullset</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="700">
                        <div class="icon-box">
                            {{-- <i class="bi bi-gem"></i> --}}
                            <i class='bxr  bxs-git-repo-forked' style="font-size: 70px;"></i>
                            <h3><a href="">Ter-organisir</a></h3>
                        </div>
                    </div>
                </div>

            </div>

    </main>

    <footer id="footer" class="footer dark-background">

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">GFORS CORP</span>
                        </a>
                        <div class="footer-contact pt-3">
                            <p>Indonesia, Jawa barat</p>
                            <p>Kab.Bandung, Bojong Tanjung</p>
                            <p class="mt-3"><strong>Phone:</strong> <span>+62
                                    877-1112-3201</span></p>
                            <p><strong>Email:</strong> <span>Gfors@Gmail.com</span></p>
                        </div>
                        <div class="social-links d-flex mt-4">
                            <a href="#" title="X"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" title="Linkind"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a>
                            </li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> About
                                    us</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">
                                    Services</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of
                                    service</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy
                                    policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Web
                                    Design</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Web
                                    Development</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Product
                                    Management</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">
                                    Marketing</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#"> Graphic
                                    Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-12 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our
                            products and services!</p>
                        <form action="forms/newsletter.php" method="post"
                            class="php-email-form">
                            <div class="newsletter-form"><input type="email"
                                    name="email"><input type="submit" value="Subscribe"></div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your subscription request has been sent.
                                Thank you!</div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="copyright">
            <div class="container text-center">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">GFORS CORP</strong>
                    <span>All Rights Reserved</span>
                </p>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you've purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed
                    by <a href="#">ThemeWagon</a>
                </div>
            </div>
        </div>
        <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 390"
            xmlns="http://www.w3.org/2000/svg"
            class="transition duration-300 ease-in-out delay-150">
            <style>
                .path-0 {
                    animation: pathAnim-0 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-0 {
                    0% {
                        d: path("M 0,400 L 0,75 C 79.57692307692307,76.51794871794871 159.15384615384613,78.03589743589744 233,83 C 306.84615384615387,87.96410256410256 374.96153846153845,96.37435897435896 463,101 C 551.0384615384615,105.62564102564104 659,106.46666666666668 738,110 C 817,113.53333333333332 867.0384615384615,119.75897435897436 942,106 C 1016.9615384615385,92.24102564102564 1116.8461538461538,58.4974358974359 1204,50 C 1291.1538461538462,41.5025641025641 1365.576923076923,58.25128205128205 1440,75 L 1440,400 L 0,400 Z");
                    }

                    25% {
                        d: path("M 0,400 L 0,75 C 96.5974358974359,67.66923076923077 193.1948717948718,60.33846153846154 260,51 C 326.8051282051282,41.66153846153846 363.81794871794875,30.315384615384623 450,39 C 536.1820512820512,47.68461538461538 671.5333333333334,76.39999999999999 750,87 C 828.4666666666666,97.60000000000001 850.0487179487181,90.08461538461538 928,92 C 1005.9512820512819,93.91538461538462 1140.2717948717948,105.26153846153848 1235,104 C 1329.7282051282052,102.73846153846152 1384.8641025641027,88.86923076923077 1440,75 L 1440,400 L 0,400 Z");
                    }

                    50% {
                        d: path("M 0,400 L 0,75 C 70.34102564102562,88.12051282051283 140.68205128205125,101.24102564102564 210,97 C 279.31794871794875,92.75897435897436 347.6128205128206,71.15641025641025 448,55 C 548.3871794871794,38.843589743589746 680.8666666666666,28.133333333333333 759,44 C 837.1333333333334,59.86666666666667 860.9205128205128,102.31025641025641 920,111 C 979.0794871794872,119.68974358974359 1073.451282051282,94.62564102564103 1166,83 C 1258.548717948718,71.37435897435897 1349.274358974359,73.18717948717949 1440,75 L 1440,400 L 0,400 Z");
                    }

                    75% {
                        d: path("M 0,400 L 0,75 C 83.13333333333335,71.85384615384615 166.2666666666667,68.70769230769231 232,67 C 297.7333333333333,65.29230769230769 346.0666666666666,65.02307692307693 440,70 C 533.9333333333334,74.97692307692307 673.4666666666668,85.20000000000002 760,79 C 846.5333333333332,72.79999999999998 880.0666666666666,50.176923076923075 956,47 C 1031.9333333333334,43.823076923076925 1150.2666666666669,60.0923076923077 1238,68 C 1325.7333333333331,75.9076923076923 1382.8666666666666,75.45384615384614 1440,75 L 1440,400 L 0,400 Z");
                    }

                    100% {
                        d: path("M 0,400 L 0,75 C 79.57692307692307,76.51794871794871 159.15384615384613,78.03589743589744 233,83 C 306.84615384615387,87.96410256410256 374.96153846153845,96.37435897435896 463,101 C 551.0384615384615,105.62564102564104 659,106.46666666666668 738,110 C 817,113.53333333333332 867.0384615384615,119.75897435897436 942,106 C 1016.9615384615385,92.24102564102564 1116.8461538461538,58.4974358974359 1204,50 C 1291.1538461538462,41.5025641025641 1365.576923076923,58.25128205128205 1440,75 L 1440,400 L 0,400 Z");
                    }
                }
            </style>
            <defs>
                <linearGradient id="gradient" x1="0%" y1="50%" x2="100%"
                    y2="50%">
                    <stop offset="5%" stop-color="#f3c623"></stop>
                    <stop offset="95%" stop-color="#333446"></stop>
                </linearGradient>
            </defs>
            <path
                d="M 0,400 L 0,75 C 79.57692307692307,76.51794871794871 159.15384615384613,78.03589743589744 233,83 C 306.84615384615387,87.96410256410256 374.96153846153845,96.37435897435896 463,101 C 551.0384615384615,105.62564102564104 659,106.46666666666668 738,110 C 817,113.53333333333332 867.0384615384615,119.75897435897436 942,106 C 1016.9615384615385,92.24102564102564 1116.8461538461538,58.4974358974359 1204,50 C 1291.1538461538462,41.5025641025641 1365.576923076923,58.25128205128205 1440,75 L 1440,400 L 0,400 Z"
                stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.4"
                class="transition-all duration-300 ease-in-out delay-150 path-0"></path>
            <style>
                .path-1 {
                    animation: pathAnim-1 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-1 {
                    0% {
                        d: path("M 0,400 L 0,175 C 84.93846153846155,163.5102564102564 169.8769230769231,152.0205128205128 255,144 C 340.1230769230769,135.9794871794872 425.4307692307691,131.42820512820512 505,150 C 584.5692307692309,168.57179487179488 658.4000000000001,210.26666666666665 741,210 C 823.5999999999999,209.73333333333335 914.9692307692308,167.50512820512822 998,165 C 1081.0307692307692,162.49487179487178 1155.7230769230769,199.7128205128205 1228,208 C 1300.2769230769231,216.2871794871795 1370.1384615384616,195.64358974358976 1440,175 L 1440,400 L 0,400 Z");
                    }

                    25% {
                        d: path("M 0,400 L 0,175 C 59.23589743589744,160.87179487179486 118.47179487179488,146.74358974358975 211,156 C 303.5282051282051,165.25641025641025 429.348717948718,197.89743589743588 519,202 C 608.651282051282,206.10256410256412 662.1333333333333,181.66666666666669 728,168 C 793.8666666666667,154.33333333333331 872.1179487179488,151.43589743589746 959,151 C 1045.8820512820512,150.56410256410254 1141.394871794872,152.5897435897436 1223,157 C 1304.605128205128,161.4102564102564 1372.302564102564,168.2051282051282 1440,175 L 1440,400 L 0,400 Z");
                    }

                    50% {
                        d: path("M 0,400 L 0,175 C 58.535897435897425,162.06153846153848 117.07179487179485,149.12307692307692 214,150 C 310.92820512820515,150.87692307692308 446.24871794871797,165.56923076923078 519,172 C 591.751282051282,178.43076923076922 601.9333333333333,176.6 681,169 C 760.0666666666667,161.4 908.0179487179489,148.03076923076924 1004,142 C 1099.982051282051,135.96923076923076 1143.9948717948719,137.27692307692308 1208,144 C 1272.0051282051281,150.72307692307692 1356.002564102564,162.86153846153846 1440,175 L 1440,400 L 0,400 Z");
                    }

                    75% {
                        d: path("M 0,400 L 0,175 C 75.87692307692308,193.8948717948718 151.75384615384615,212.7897435897436 223,201 C 294.24615384615385,189.2102564102564 360.86153846153843,146.73589743589744 452,145 C 543.1384615384616,143.26410256410256 658.8000000000001,182.26666666666662 755,184 C 851.1999999999999,185.73333333333338 927.9384615384618,150.19743589743592 998,150 C 1068.0615384615382,149.80256410256408 1131.4461538461537,184.94358974358974 1204,195 C 1276.5538461538463,205.05641025641026 1358.2769230769231,190.02820512820512 1440,175 L 1440,400 L 0,400 Z");
                    }

                    100% {
                        d: path("M 0,400 L 0,175 C 84.93846153846155,163.5102564102564 169.8769230769231,152.0205128205128 255,144 C 340.1230769230769,135.9794871794872 425.4307692307691,131.42820512820512 505,150 C 584.5692307692309,168.57179487179488 658.4000000000001,210.26666666666665 741,210 C 823.5999999999999,209.73333333333335 914.9692307692308,167.50512820512822 998,165 C 1081.0307692307692,162.49487179487178 1155.7230769230769,199.7128205128205 1228,208 C 1300.2769230769231,216.2871794871795 1370.1384615384616,195.64358974358976 1440,175 L 1440,400 L 0,400 Z");
                    }
                }
            </style>
            <defs>
                <linearGradient id="gradient" x1="0%" y1="50%" x2="100%"
                    y2="50%">
                    <stop offset="5%" stop-color="#f3c623"></stop>
                    <stop offset="95%" stop-color="#333446"></stop>
                </linearGradient>
            </defs>
            <path
                d="M 0,400 L 0,175 C 84.93846153846155,163.5102564102564 169.8769230769231,152.0205128205128 255,144 C 340.1230769230769,135.9794871794872 425.4307692307691,131.42820512820512 505,150 C 584.5692307692309,168.57179487179488 658.4000000000001,210.26666666666665 741,210 C 823.5999999999999,209.73333333333335 914.9692307692308,167.50512820512822 998,165 C 1081.0307692307692,162.49487179487178 1155.7230769230769,199.7128205128205 1228,208 C 1300.2769230769231,216.2871794871795 1370.1384615384616,195.64358974358976 1440,175 L 1440,400 L 0,400 Z"
                stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="0.53"
                class="transition-all duration-300 ease-in-out delay-150 path-1"></path>
            <style>
                .path-2 {
                    animation: pathAnim-2 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-2 {
                    0% {
                        d: path("M 0,400 L 0,275 C 87.49230769230772,285.6025641025641 174.98461538461544,296.20512820512823 259,290 C 343.01538461538456,283.79487179487177 423.55384615384605,260.7820512820513 488,251 C 552.446153846154,241.21794871794867 600.8000000000001,244.66666666666666 685,242 C 769.1999999999999,239.33333333333334 889.2461538461537,230.55128205128207 987,239 C 1084.7538461538463,247.44871794871793 1160.2153846153847,273.12820512820514 1232,282 C 1303.7846153846153,290.87179487179486 1371.8923076923077,282.93589743589746 1440,275 L 1440,400 L 0,400 Z");
                    }

                    25% {
                        d: path("M 0,400 L 0,275 C 79.95897435897436,284.0948717948718 159.91794871794872,293.18974358974356 228,302 C 296.0820512820513,310.81025641025644 352.2871794871795,319.33589743589744 437,307 C 521.7128205128205,294.66410256410256 634.9333333333332,261.4666666666667 733,255 C 831.0666666666668,248.53333333333333 913.9794871794875,268.7974358974359 978,270 C 1042.0205128205125,271.2025641025641 1087.1487179487178,253.34358974358977 1161,251 C 1234.8512820512822,248.65641025641023 1337.4256410256412,261.8282051282051 1440,275 L 1440,400 L 0,400 Z");
                    }

                    50% {
                        d: path("M 0,400 L 0,275 C 59.52564102564102,260.62051282051283 119.05128205128204,246.24102564102563 195,246 C 270.94871794871796,245.75897435897437 363.3205128205128,259.6564102564102 451,271 C 538.6794871794872,282.3435897435898 621.6666666666667,291.1333333333333 705,280 C 788.3333333333333,268.8666666666667 872.0128205128206,237.81025641025641 950,240 C 1027.9871794871794,242.18974358974359 1100.2820512820513,277.625641025641 1181,289 C 1261.7179487179487,300.374358974359 1350.8589743589744,287.6871794871795 1440,275 L 1440,400 L 0,400 Z");
                    }

                    75% {
                        d: path("M 0,400 L 0,275 C 90.65384615384616,285.8820512820513 181.30769230769232,296.76410256410253 260,297 C 338.6923076923077,297.23589743589747 405.4230769230769,286.825641025641 473,274 C 540.5769230769231,261.174358974359 609,245.93333333333334 703,253 C 797,260.06666666666666 916.5769230769231,289.44102564102565 991,300 C 1065.423076923077,310.55897435897435 1094.6923076923076,302.3025641025641 1162,295 C 1229.3076923076924,287.6974358974359 1334.6538461538462,281.348717948718 1440,275 L 1440,400 L 0,400 Z");
                    }

                    100% {
                        d: path("M 0,400 L 0,275 C 87.49230769230772,285.6025641025641 174.98461538461544,296.20512820512823 259,290 C 343.01538461538456,283.79487179487177 423.55384615384605,260.7820512820513 488,251 C 552.446153846154,241.21794871794867 600.8000000000001,244.66666666666666 685,242 C 769.1999999999999,239.33333333333334 889.2461538461537,230.55128205128207 987,239 C 1084.7538461538463,247.44871794871793 1160.2153846153847,273.12820512820514 1232,282 C 1303.7846153846153,290.87179487179486 1371.8923076923077,282.93589743589746 1440,275 L 1440,400 L 0,400 Z");
                    }
                }
            </style>
            <defs>
                <linearGradient id="gradient" x1="0%" y1="50%" x2="100%"
                    y2="50%">
                    <stop offset="5%" stop-color="#f3c623"></stop>
                    <stop offset="95%" stop-color="#333446"></stop>
                </linearGradient>
            </defs>
            <path
                d="M 0,400 L 0,275 C 87.49230769230772,285.6025641025641 174.98461538461544,296.20512820512823 259,290 C 343.01538461538456,283.79487179487177 423.55384615384605,260.7820512820513 488,251 C 552.446153846154,241.21794871794867 600.8000000000001,244.66666666666666 685,242 C 769.1999999999999,239.33333333333334 889.2461538461537,230.55128205128207 987,239 C 1084.7538461538463,247.44871794871793 1160.2153846153847,273.12820512820514 1232,282 C 1303.7846153846153,290.87179487179486 1371.8923076923077,282.93589743589746 1440,275 L 1440,400 L 0,400 Z"
                stroke="none" stroke-width="0" fill="url(#gradient)" fill-opacity="1"
                class="transition-all duration-300 ease-in-out delay-150 path-2"></path>
        </svg>
    </footer>
</x-guest-layout>
