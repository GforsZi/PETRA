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

                <li class="nav-item">
                    <a href="#" class="nav-link" style='color: #E9AD01;'>
                        <i class="bi bi-book"></i>
                        <p>
                            Kelola Buku
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style='color: #E9AD01;'>
                            <a href="/manage/book" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Lihat</p>
                            </a>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style='color: #E9AD01;'>
                        <i class="bi bi-person-badge"></i>
                        <p>
                            Kelola Pengguna
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/account" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Kelola Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/role" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Kelola Peran</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style='color: #E9AD01;'>
                        <i class="bi bi-file-earmark-ruled"></i>
                        <p>
                            Kelola Peminjaman
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style='color: #E9AD01;'>
                            <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Lihat</p>
                            </a>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style='color: #E9AD01;'>
                        <i class="bi bi-speedometer"></i>
                        <p>
                            Kelola Laporan
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style='color: #E9AD01;'>
                            <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Lihat</p>
                            </a>
                    </ul>
                </li>
            </ul>

            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
