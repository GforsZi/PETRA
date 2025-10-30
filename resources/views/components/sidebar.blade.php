<aside class="app-sidebar shadow" data-bs-theme="dark" style="background-color: #121740;">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="/" class="brand-link">
            <img src="{{ asset('/logo/PETRA-LOGO.png') }}" alt="Logo" class="brand-image opacity-75 shadow" />
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @if (auth()->user()?->roles['rl_admin'] ?? '0' == '1')
                    {{-- DASHBOARD --}}
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ set_active('dashboard') }}" style="color: #E9AD01;">
                            <i class="bi bi-grid-1x2"></i>
                            <p>Dasbor</p>
                        </a>
                    </li>

                    {{-- BIBLIOGRAPHY --}}
                    <li class="nav-item {{ set_menu_open(['manage/book*']) }}">
                        <a href="#" class="nav-link {{ set_active(['manage/book*']) }}" style="color: #E9AD01;">
                            <i class="bi bi-book"></i>
                            <p>
                                Bibliography
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ Request::is('manage/book*') ? 'display:block;' : '' }}">
                            <li class="nav-item">
                                <a href="/manage/book" class="nav-link {{ set_active('manage/book') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data buku</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/book/major" class="nav-link {{ set_active('manage/book/major') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data jurusan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/book/author" class="nav-link {{ set_active('manage/book/author') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data penulis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/book/publisher" class="nav-link {{ set_active('manage/book/publisher') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data penerbit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/book/origin" class="nav-link {{ set_active('manage/book/origin') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data sumber</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/book/ddc" class="nav-link {{ set_active('manage/book/ddc') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data klasifikasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- KEANGGOTAAN --}}
                    <li class="nav-item {{ set_menu_open(['manage/account*', 'manage/role*']) }}">
                        <a href="#" class="nav-link {{ set_active(['manage/account*', 'manage/role*']) }}" style="color: #E9AD01;">
                            <i class="bi bi-person-badge"></i>
                            <p>Keanggotan<i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ Request::is('manage/account*') || Request::is('manage/role*') ? 'display:block;' : '' }}">
                            <li class="nav-item">
                                <a href="/manage/account" class="nav-link {{ set_active('manage/account') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data akun</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/role" class="nav-link {{ set_active('manage/role') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data peran</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- SISTEM --}}
                    <li class="nav-item {{ set_menu_open(['manage/chat*']) }}">
                        <a href="#" class="nav-link {{ set_active(['manage/chat*']) }}" style="color: #E9AD01;">
                            <i class="bi bi-whatsapp"></i>
                            <p>Sistem<i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ Request::is('manage/chat*') ? 'display:block;' : '' }}">
                            <li class="nav-item">
                                <a href="/manage/chat/device" class="nav-link {{ set_active('manage/chat/device') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data perangkat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/chat/option" class="nav-link {{ set_active('manage/chat/option') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data opsi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- SIRKULASI --}}
                    <li class="nav-item {{ set_menu_open(['manage/transaction*', 'manage/submission*', 'manage/loan*', 'manage/return*']) }}">
                        <a href="#" class="nav-link {{ set_active(['manage/transaction*', 'manage/submission*', 'manage/loan*', 'manage/return*']) }}" style="color: #E9AD01;">
                            <i class="bi bi-file-earmark-ruled"></i>
                            <p>Sirkulasi<i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview"
                            style="{{ Request::is('manage/transaction*') || Request::is('manage/submission*') || Request::is('manage/loan*') || Request::is('manage/return*') ? 'display:block;' : '' }}">
                            <li class="nav-item">
                                <a href="/manage/transaction" class="nav-link {{ set_active('manage/transaction') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data transaksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/submission" class="nav-link {{ set_active('manage/submission') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data pengajuan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/loan" class="nav-link {{ set_active('manage/loan') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data peminjaman</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/return" class="nav-link {{ set_active('manage/return') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Data pengembalian</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- PELAPORAN --}}
                    <li class="nav-item {{ set_menu_open(['manage/export*']) }}">
                        <a href="#" class="nav-link {{ set_active(['manage/export*']) }}" style="color: #E9AD01;">
                            <i class="bi bi-filetype-pdf"></i>
                            <p>Pelaporan<i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ Request::is('manage/export*') ? 'display:block;' : '' }}">
                            <li class="nav-item">
                                <a href="/manage/export/collection" class="nav-link {{ set_active('manage/export/collection') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Koleksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/export/statistics" class="nav-link {{ set_active('manage/export/statistics') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Statistik</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/export/memberships" class="nav-link {{ set_active('manage/export/memberships') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Anggota</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/manage/export/transaction" class="nav-link {{ set_active('manage/export/transaction') }}" style="color: #E9AD01;">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Transaksi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- MENU UNTUK NON-ADMIN --}}
                    <li class="nav-item">
                        <a href="/home" class="nav-link {{ set_active('home') }}" style="color: #E9AD01;">
                            <i class="bi bi-house"></i>
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/search/book" class="nav-link {{ set_active('search/book') }}" style="color: #E9AD01;">
                            <i class="bi bi-book"></i>
                            <p>Cari buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transaction" class="nav-link {{ set_active('transaction') }}" style="color: #E9AD01;">
                            <i class="bi bi-file-earmark-post"></i>
                            <p>Kelola pinjaman</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
