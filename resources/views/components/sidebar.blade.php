<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="/" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('/logo/uni_invt.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow rounded-circle" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">UNI-INVT</span>
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
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>View</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-person-circle"></i>
                        <p>
                            Accounts
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/account" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/role" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management role</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Assets
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/asset?category=all" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management asset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/asset/category" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>management category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/manage/asset/origin" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>management origin</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-geo-alt"></i>
                        <p>
                            Locations
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/location" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management location</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-clipboard-data"></i>
                        <p>
                            Loans
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/loan" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management loan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <p>
                            Returns
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/manage/return" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Management return</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-pencil-square"></i>
                        <p>
                            Reports
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/report" class="nav-link">
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
{{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3 shadow">
     <div class="modal-body p-4 text-center">
       <h5 class="mb-0">Select asset category</h5>
       <p class="mb-0">You can always change your mind in your account settings.</p>
     </div>
     <div class="modal-footer flex-nowrap p-0">
       <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button>
       <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button>
     </div>
   </div>
  </div>
</div> --}}
