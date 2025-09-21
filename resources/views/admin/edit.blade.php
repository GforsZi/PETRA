<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form class="container mt-4">
        <div class="row g-4 align-items-start">

            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                <img src="{{ asset($account['usr_img_url'] ?? '/logo/uni_invt.png') }}"
                    class="rounded-circle shadow object-fit-cover mb-2" alt="Profile Image"
                    width="200" height="200">
                <input type="file" id="profileImage" class="d-none">
                <a href="#" class="text-decoration-none"
                    onclick="document.getElementById('profileImage').click();">Ubah Foto Profil</a>
            </div>

            <div class="col-12 col-md-8">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" class="form-control" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">No WhatsApp</label>
                    <input type="text" id="whatsapp" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password" class="form-control" autocomplete="off">
                </div>

                <!-- From Uiverse.io by adamgiebl -->
                <div class="d-flex justify-content-center">
                    <button type="submit"
                        class=" w-50 d-flex justify-content-center align-items-center"
                        id="tombol"> Selesai</button>

                </div>
            </div>

        </div>
    </form>
    <style>
        /* From Uiverse.io by adamgiebl */
        #tombol {
            --green: #1BFD9C;
            font-size: 15px;
            padding: 0.7em 2.7em;
            letter-spacing: 0.06em;
            position: relative;
            font-family: inherit;
            border-radius: 0.6em;
            overflow: hidden;
            transition: all 0.3s;
            line-height: 1.4em;
            border: 2px solid var(--green);
            background: linear-gradient(to right, rgba(27, 253, 156, 0.1) 1%, transparent 40%, transparent 60%, rgba(27, 253, 156, 0.1) 100%);
            color: var(--green);
            box-shadow: inset 0 0 10px rgba(27, 253, 156, 0.4), 0 0 9px 3px rgba(27, 253, 156, 0.1);
        }

        #tombol:hover {
            color: #82ffc9;
            box-shadow: inset 0 0 10px rgba(27, 253, 156, 0.6), 0 0 9px 3px rgba(27, 253, 156, 0.2);
        }

        #tombol:before {
            content: "";
            position: absolute;
            left: -4em;
            width: 4em;
            height: 100%;
            top: 0;
            transition: transform .4s ease-in-out;
            background: linear-gradient(to right, transparent 1%, rgba(27, 253, 156, 0.1) 40%, rgba(27, 253, 156, 0.1) 60%, transparent 100%);
        }

        #tombol:hover:before {
            transform: translateX(30em);
        }
    </style>
</x-app-layout>
