<nav class="app-header navbar navbar-expand" style="background-color: #121740;">
    <div class="container-fluid">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center justify-content-center"
                   data-lte-toggle="sidebar" href="#" role="button"
                   style="padding: 0.5rem; height: 40px; width: 40px;">
                    <i class="bi bi-list fs-4" style="color: #E9AD01;"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ url()->previous() }}"
                   class="nav-link d-flex align-items-center justify-content-center"
                   style="padding: 0.5rem; height: 40px; width: 40px;">
                    <i class="bi bi-arrow-left-circle fs-4" style="color: #E9AD01;"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item dropdown">
                <button
                    class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                    id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                    data-bs-display="static" style="color: #E9AD01;">
                    <span class="theme-icon-active">
                        <i class="my-1" style="color: #E9AD01;"></i>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text"
                    style="--bs-dropdown-min-width: 8rem;">
                    <li>
                        <button type="button"
                            class="dropdown-item d-flex align-items-center active"
                            data-bs-theme-value="light" aria-pressed="false">
                            <i class="bi bi-sun-fill me-2" style="color: #E9AD01;"></i>
                            Light
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="dark" aria-pressed="false">
                            <i class="bi bi-moon-fill me-2" style="color: #E9AD01;"></i>
                            Dark
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="auto" aria-pressed="true">
                            <i class="bi bi-circle-half me-2" style="color: #E9AD01;"></i>
                            Auto
                        </button>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill" style="color: #E9AD01;"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen" style="color: #E9AD01;"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display:none;color:#E9AD01;"></i>
                </a>
            </li>

            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset(Auth::user()->usr_card_url ?? '/logo/user_placeholder.jpg') }}"
                        class="user-image rounded-circle shadow object-fit-cover"
                        alt="User Image" style="width: 35px; height: 35px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header" style="background-color: #121740;">
                        <img src="{{ asset(Auth::user()->usr_card_url ?? '/logo/user_placeholder.jpg') }}"
                            class="rounded-circle shadow object-fit-cover" alt="" />
                        <p style="color: #E9AD01;">
                            {{ Auth::user()->name }}
                            <small style="color: #E9AD01;">Bergabung sejak {{ Auth::user()->usr_created_at->format('F Y') }}</small>
                        </p>
                    </li>
                    <li class="user-footer">
                        @if (auth()->user()?->roles['rl_admin'] ?? 0 == 1)
                            <a href="/admin/profile" class="btn btn-default btn-flat">Profil</a>
                        @else
                            <a href="/user/profile" class="btn btn-default btn-flat">Profil</a>
                        @endif
                        <a href="/logout" class="btn btn-default btn-flat float-end">Sign out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
