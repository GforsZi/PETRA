<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        .kamera {
            height: 2.8em;
            width: 9em;
            background: transparent;
            border: 2px solid #016dd9;
            outline: none;
            color: #016dd9;
            cursor: pointer;
            font-size: 17px;
        }

        .kamera:hover {
            background: #016dd9;
            color: #ffffff;
            animation: squeeze3124 0.9s both;
        }

        .save {
            height: 2.8em;
            width: 9em;
        }

        .camera-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .camera-grid {
            position: absolute;
            inset: 0;
            pointer-events: none;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
        }

        .camera-grid div {
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .kartu-perpus {
            width: 450px;
            border: 1px solid #000;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .kartu-body {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            gap: 20px;
        }

        .foto-box {
            width: 120px;
            height: 150px;
            border: 1px solid #000;
            background: #f5f5f5;
            object-fit: cover;
            border-radius: 6px;
        }

        .damy {
            display: flex;
            flex-direction: column;
            gap: 14px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
    <div class="container mt-4">
        <div class="row justify-content-center align-items-start g-4">
            <!-- Kamera -->
            <div class="col-md-5 text-center">
                <h4 class="fw-bold mb-3">Ambil Foto</h4>

                <div class="camera-container">
                    <video id="camera" autoplay playsinline width="100%" class="border rounded bg-dark"></video>

                    <div class="camera-grid">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

                <canvas id="canvas" width="320" height="240" class="d-none"></canvas>

                <!-- Form Upload -->
                <form id="photoForm" method="POST" action="/system/user/activation" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="file" name="image" id="photoInput" class="d-none" accept="image/*">

                    <div class="mt-3">
                        <button type="button" id="captureBtn" class="kamera me-2">
                            <i class="bi bi-camera-fill"></i> Ambil
                        </button>
                        <button type="submit" id="uploadBtn" class="save btn btn-success d-none" onclick="this.disabled=true; this.form.submit();">
                            <i class="bi bi-bookmark-check-fill"></i> Simpan
                        </button>
                    </div>
                </form>

                <p id="cameraError" class="text-danger mt-2" style="display:none;">
                    ❌ Kamera tidak dapat diakses. Pastikan izin diberikan.
                </p>
            </div>

            <!-- Kartu di samping kanan -->
            <div class="col-md-6">
                <div class="kartu-perpus shadow">
                    <img src="{{ asset('logo/cop_kartu.svg') }}" alt="Cop Kartu" style="width:100%; height:100%; display:block; object-fit: cover;">

                    <div class="kartu-body">
                        <img id="preview" src="{{ asset($user->usr_card_url ?? 'logo/user_placeholder.jpg') }}" class="foto-box" alt="Foto" />
                        <div class="damy">
                            <span style="color: black;"><strong>Nama Lengkap</strong>:
                                {{ $user->name }}</span>
                            <span style="color: black;"><strong>Nomor Whatsapp</strong>:
                                {{ $user->usr_no_wa }}</span>
                            <span style="color: black;"><strong>Bergabung sejak</strong>:
                                {{ $user->usr_created_at->format('d M Y') }}</span>
                            <span style="color: black;"><strong>Peran</strong>:
                                {{ $user->roles->rl_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const video = document.getElementById("camera");
            const canvas = document.getElementById("canvas");
            const captureBtn = document.getElementById("captureBtn");
            const uploadBtn = document.getElementById("uploadBtn");
            const preview = document.getElementById("preview");
            const cameraError = document.getElementById("cameraError");
            const photoInput = document.getElementById("photoInput");

            // Aktifkan kamera
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(err => {
                    cameraError.style.display = "block";
                    console.error("Kamera error:", err);
                });

            // Ambil foto
            captureBtn.addEventListener("click", () => {
                const ctx = canvas.getContext("2d");
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const dataURL = canvas.toDataURL("image/png");
                preview.src = dataURL;

                // Ubah base64 jadi blob lalu masukkan ke input file
                fetch(dataURL)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], "photo.png", {
                            type: "image/png"
                        });
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        photoInput.files = dataTransfer.files;
                    });

                uploadBtn.classList.remove("d-none");
            });
        });
    </script>
</x-app-layout>
