<aside class="app-sidebar  shadow" data-bs-theme="dark" style="background-color: #121740;">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="/" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('/logo/PETRA-LOGO.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                data-accordion="false">
                @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
                    <li class="nav-item">
                        <a href="#" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-book"></i>
                            <p>
                                BIBLIOGRAPHY
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/book" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA BUKU</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/book/major" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA JURUSAN</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/book/author" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA PENULIS</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/book/publisher" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA PENERBIT</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/book/origin" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA ASAL</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/book/ddc" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA KLASIFIKASI</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-person-badge"></i>
                            <p>
                                KEANGGOTAAN
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/manage/account" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA AKUN</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/role" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA PERAN</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-whatsapp"></i>
                            <p>
                                SISTEM
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/manage/chat/device" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA PERANGKAT</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/chat/option" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA OPSI</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-file-earmark-ruled"></i>
                            <p>
                                SIRKULASI
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/loan" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA PEMINJAMAN</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/manage/return" class="nav-link"
                                    style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>DATA PENGEMBALIAN</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-filetype-pdf"></i>
                            <p>
                                PELAPORAN
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>STATISTIK KOLEKSI</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>STATISTIK PERBULAN</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>LAPORAN PEMINJAMAN</p>
                                </a>
                            </li>
                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>LAPORAN ANGGOTA</p>
                                </a>
                            </li>


                            <li class="nav-item" style='color: #E9AD01;'>
                                <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>STATISTIK PENGEMBALIAN</p>
                                </a>
                            </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/home" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-house"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/search/book" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-book"></i>
                            <p>
                                Cari Buku
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transaction" class="nav-link" style='color: #E9AD01;'>
                            <i class="bi bi-file-earmark-post"></i>
                            <p>
                                Kelola Pinjaman
                            </p>
                        </a>
                    </li>
                @endif
            </ul>

            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
