<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @endif
    <div class="profil">
        <div class="card shadow-sm mb-3 w-100">
            <div class="row g-0 align-items-center">

                <div class="col-12 col-md-4 d-flex justify-content-center p-3">
                    <img src="{{ asset($user['usr_card_url'] ?? '/logo/user_placeholder.jpg') }}" class="rounded-circle shadow object-fit-cover" alt="Profile Image" width="200" height="200">
                </div>

                <div class="col-12 col-md-8">
                    <div class="card-body text-center text-md-start">
                        <h5 class="card-title mb-3"></h5>

                        <div class="d-flex justify-content-start mb-2">
                            <strong>Nama:</strong>
                            <span class="ms-3">{{ $user['name'] }}</span>
                        </div>

                        <div class="d-flex justify-content-start mb-2">
                            <strong>Nomor WhatsApp:</strong>
                            <span class="ms-3">{{ $user['usr_no_wa'] }}</span>
                        </div>

                        <div class="d-flex justify-content-start mb-2">
                            <strong>Peran:</strong>
                            <span class="ms-3">{{ $user['roles']['rl_name'] }}</span>
                        </div>

                        <div class="d-flex justify-content-start mb-2">
                            <strong>Status:</strong>
                            <span class="ms-3">
                                @if ($user['usr_activation'])
                                    Sudah teraktivasi
                                @else
                                    Terblokir
                                @endif
                            </span>
                        </div>

                        <div class="mt-3 d-flex gap-2">
                            <button class="button bg-body flex-center" title="Riwayat Data">
                                <a href="/manage/history"><i class="bi bi-clock-history text-danger  fs-4"></i></a>
                            </button>
                            <button class="button bg-body flex-center" title="Ubah profil">
                                <a href="/admin/profile/edit"> <i class="bi bi-pencil-square text-info fs-4"></i></a>
                            </button>
                            <button class="button bg-body flex-center" title="Buat Kartu">
                                <a href="/admin/profile/activation"> <i class="bi bi-camera text-primary fs-4"></i></a>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- From Uiverse.io by Pradeepsaranbishnoi -->
    <!-- From Uiverse.io by MarcLazz -->

    <style>
        /* From Uiverse.io by MarcLazz */
        .button {
            cursor: pointer;
            text-decoration: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid #2d2e32;
            transition: all 0.45s;
        }

        .button:hover {
            transform: rotate(360deg);
            transform-origin: center center;
            background-color: gray;
            color: #2d2e32;
        }

        .button:hover .btn-svg {
            filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(305deg) brightness(103%) contrast(103%);
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</x-app-layout>
