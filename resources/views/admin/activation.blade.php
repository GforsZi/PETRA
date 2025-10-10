<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        /* Tombol kamera */
        /* From Uiverse.io by Botwe-Felix5820 */
        .kamera {
            height: 2.8em;
            width: 9em;
            background: transparent;
            -webkit-animation: jello-horizontal 0.9s both;
            animation: jello-horizontal 0.9s both;
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

        @keyframes squeeze3124 {
            0% {
                transform: scale3d(1, 1, 1);
            }

            30% {
                transform: scale3d(1.25, 0.75, 1);
            }

            40% {
                transform: scale3d(0.75, 1.25, 1);
            }

            50% {
                transform: scale3d(1.15, 0.85, 1);
            }

            65% {
                transform: scale3d(0.95, 1.05, 1);
            }

            75% {
                transform: scale3d(1.05, 0.95, 1);
            }

            100% {
                transform: scale3d(1, 1, 1);
            }
        }

        .save{
             height: 2.8em;
            width: 9em;
        }
        /* Gridline overlay di kamera */
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

        /* Desain kartu perpustakaan */
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

        .damy span {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            letter-spacing: 0.3px;
        }

        .damy strong {
            display: inline-block;
            width: 120px;
            text-align: left;
        }

     
@media (min-width: 992px) {
    .kartu-perpus {
        margin-top: 45px; /* atur jarak ke bawah biar sejajar dengan kamera */
    }
}

   
@media (max-width: 767.98px) {

  .row.justify-content-center.align-items-start.g-4 {
    flex-direction: column;
    align-items: center !important;
    
  }

 
  .col-md-6 {
    display: flex;
    justify-content: center;
    align-items: center;
    min-width: 0; 
  }

 
  .kartu-perpus {
    margin: 16px auto;     
    position: static;     
    left: auto;
    transform: none;
    width: 450px;          
    max-width: 92vw;
           
  }
}


    </style>

    <div class="container mt-4">
        <div class="row justify-content-center align-items-start g-4">
            <!-- Kamera -->
            <div class="col-md-5 text-center">
                <h4 class="fw-bold mb-3">Ambil Foto</h4>

                <div class="camera-container">
                    <video id="camera" autoplay playsinline width="100%"
                        class="border rounded bg-dark"></video>

                    <!-- Garis grid -->
                    <div class="camera-grid">
                        <div></div><div></div><div></div>
                        <div></div><div></div><div></div>
                        <div></div><div></div><div></div>
                    </div>
                </div>

                <canvas id="canvas" width="320" height="240" class="d-none"></canvas>

                <div class="mt-3">
                    <button id="captureBtn" class="kamera me-2" title="Ambil gambar">
                        <i class="bi bi-camera-fill"></i>
                    </button>
                    <button id="uploadBtn" class="save btn btn-success d-none me-2">
                        <i class="bi bi-bookmark-check-fill"></i> Simpan
                    </button>
                </div>

                <p id="cameraError" class="text-danger mt-2" style="display:none;">
                    ❌ Kamera tidak dapat diakses. Pastikan izin diberikan.
                </p>
            </div>

            <!-- Kartu di samping kanan -->
            <div class="col-md-6">
                <div class="kartu-perpus shadow">
                    <img src="{{ asset('logo/cop_kartu.svg') }}" alt="Cop Kartu"
                        style="width:100%; height:100%; display:block; object-fit: cover;">

                    <div class="kartu-body">
                        <img id="preview" src="{{ asset('logo/user_placeholder.jpg') }}"
                            class="foto-box" alt="Foto" />
                        <div class="damy">
                            <span style="color: black;"><strong>Nama Lengkap</strong>: </span>
                            <span style="color: black;"><strong>No. WhatsApp</strong>: </span>
                            <span style="color: black;"><strong>Bergabung sejak</strong>: </span>
                            <span style="color: black;"><strong>Sebagai</strong>: </span>
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

        // Aktifkan kamera
        navigator.mediaDevices.getUserMedia({ video: true })
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

            // Tampilkan tombol simpan setelah foto diambil
            uploadBtn.classList.remove("d-none");
        });
    });
    </script>
</x-app-layout>
