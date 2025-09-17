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
            <span class="brand-text fw-light">PETRA</span>
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
                        <i class="bi bi-person-circle"></i>
                        <p>
                            Accounts
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/account" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/role" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management role</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" style='color: #E9AD01;'>
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Reports
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" style='color: #E9AD01;'>
                            <a href="/report" class="nav-link" style='color: #E9AD01;'>
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View</p>
                            </a>
                    </ul>
                </li>
            </ul>

            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
