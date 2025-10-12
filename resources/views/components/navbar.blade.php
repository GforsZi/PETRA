<nav class="app-header navbar navbar-expand" style="background-color: #121740;">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            {{-- @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
            @endif --}}
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list" style='color: #E9AD01;'></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ url()->previous() }}"
                    class="nav-link" style='color: #E9AD01;'>Kembali</a></li>
            @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
                <li class="nav-item d-none d-md-block"><a href="/dashboard" class="nav-link"
                        style='color: #E9AD01;'>Dasboard</a></li>
            @else
                <li class="nav-item d-none d-md-block"><a href="/home" class="nav-link"
                        style='color: #E9AD01;'>Home</a>
                </li>
            @endif
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <!--end::Navbar Search-->
            <li class="nav-item dropdown">
                <button
                    class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                    id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                    data-bs-display="static" style='color: #E9AD01;'>
                    <span class="theme-icon-active">
                        <i class="my-1" style='color: #E9AD01;'></i>
                    </span>
                    <span class="d-lg-none" id="bd-theme-text"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text"
                    style="--bs-dropdown-min-width: 8rem;">
                    <li>
                        <button type="button"
                            class="dropdown-item d-flex align-items-center active"
                            data-bs-theme-value="light" aria-pressed="false">
                            <i class="bi bi-sun-fill me-2" style='color: #E9AD01;'></i>
                            Light
                            <i class="bi bi-check-lg ms-auto d-none" style='color: #E9AD01;'></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="dark" aria-pressed="false">
                            <i class="bi bi-moon-fill me-2" style='color: #E9AD01;'></i>
                            Dark
                            <i class="bi bi-check-lg ms-auto d-none" style='color: #E9AD01;'></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="auto" aria-pressed="true">
                            <i class="bi bi-circle-half me-2" style='color: #E9AD01;'></i>
                            Auto
                            <i class="bi bi-check-lg ms-auto d-none" style='color: #E9AD01;'></i>
                        </button>
                    </li>
                </ul>
            </li>
            <!--begin::Messages Dropdown Menu-->
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown" style='color: #E9AD01;'>
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill" style='color: #E9AD01;'></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"> See All Notifications
                    </a>
                </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"
                        style='color: #E9AD01;'></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit"
                        style="display: none; color: #E9AD01;"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset(Auth::user()->usr_card_url ?? '/logo/user_placeholder.jpg') }}"
                        class="user-image rounded-circle shadow object-fit-cover"
                        alt="" />
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!--begin::User Image-->
                    <li class="user-header" style="background-color: #121740;">
                        <img src="{{ asset(Auth::user()->usr_card_url ?? '/logo/user_placeholder.jpg') }}"
                            class="rounded-circle shadow object-fit-cover" alt="" />
                        <p style='color: #E9AD01;'>
                            {{ Auth::user()->name }}
                            <small style='color: #E9AD01;'>Bergabung sejak
                                {{ Auth::user()->usr_created_at->format('F Y') }}</small>
                        </p>
                    </li>
                    <!--end::User Image-->
                    <!--begin::Menu Body-->
                    <li class="user-body">
                        <!--begin::Row-->
                        <div class="row">
                        </div>
                        <!--end::Row-->
                    </li>
                    <!--end::Menu Body-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer">
                        @if (auth()->user()?->roles['rl_admin'] ?? 0 == 1)
                            <a href="/admin/profile" class="btn btn-default btn-flat">Profil</a>
                        @else
                            <a href="/user/profile" class="btn btn-default btn-flat">Profil</a>
                        @endif
                        <a href="/logout" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
