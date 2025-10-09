<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        /* Tombol kamera */
        /* From Uiverse.io by Botwe-Felix5820 */ 
button {
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

button:hover {
  background: #016dd9;
  color: #ffffff;
  animation: squeeze3124 0.9s both;
}

@keyframes squeeze3124 {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }

  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }

  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }

  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }

  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }

  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }

  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
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

        .form-box {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 10px;
            padding-top: 5px;
        }

        .form-box span {
            display: block;
            background: #e0e0e0;
            border-radius: 20px;
            padding: 6px 15px;
            font-size: 14px;
        }

        #role {
            width: 50%;
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
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center align-items-start g-4">
            <!-- Kamera -->
            <div class="col-md-5 text-center">
                <h4 class="fw-bold mb-3">Ambil Foto</h4>
                <video id="camera" autoplay playsinline width="100%"
                    class="border rounded bg-dark"></video>
                <canvas id="canvas" width="320" height="240" class="d-none"></canvas>

                <div class="mt-3">
                    <button id="captureBtn" class="kamera me-2" title="Ambil gambar">
                        <i class="bi bi-camera-fill"></i>
                    </button>
                    <button id="uploadBtn" class="btn btn-success d-none">
                        <i class="bi bi-bookmark-check-fill"></i> Simpan
                    </button>
                </div>

                <p id="cameraError" class="text-danger mt-2" style="display:none;">
                    ❌ Kamera tidak dapat diakses. Pastikan izin diberikan.
                </p>
            </div>

            <!-- Kartu di samping kanan -->
           

    <script>
        const video = document.getElementById("camera");
        const canvas = document.getElementById("canvas");
        const captureBtn = document.getElementById("captureBtn");
        const uploadBtn = document.getElementById("uploadBtn");
        const preview = document.getElementById("preview");
        const cameraError = document.getElementById("cameraError");

        // Aktifkan kamera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                cameraError.style.display = "block";
                console.error("Kamera error:", err);
            });

        // Ambil foto
        captureBtn.onclick = function() {
            const ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL("image/png");
            preview.src = dataURL;
        };
    </script>
</x-app-layout>
