<x-app-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <style>
    /* Tombol kamera */
    .camera {
      height: 2.8em;
      width: 9em;
      background: transparent;
      border: 2px solid #016dd9;
      color: #016dd9;
      cursor: pointer;
      font-size: 17px;
      transition: all 0.3s ease;
    }
    .camera:hover {
      background: #016dd9;
      color: #fff;
    }

    /* Desain kartu perpustakaan */
    .kartu-perpus {
      width: 450px;
      border: 1px solid #000;
      border-radius: 8px;
      overflow: hidden;
      background: #fff;
    }

    .kartu-header {
      background-color: #0c1b45;
      color: #ffd700;
      padding: 10px 20px;
      position: relative;
      display: flex;
      align-items: center;
    }

    .kartu-header img {
      height: 45px;
      margin-right: 10px;
    }

    .kartu-header::after {
      content: "";
      position: absolute;
      right: 0;
      top: 0;
      bottom: 0;
      width: 120px;
      background: #e76124;
      clip-path: polygon(25% 0, 100% 0, 100% 100%, 0 100%);
    }

    .kartu-body {
      display: flex;
      align-items: center;
      padding: 20px;
    }

    .foto-box {
      width: 120px;
      height: 150px;
      border: 1px solid #000;
      background: #f5f5f5;
      object-fit: cover;
    }

    .form-box {
      flex: 1;
      margin-left: 20px;
    }

    .form-box input {
      width: 100%;
      height: 32px;
      border-radius: 20px;
      border: none;
      background: #e0e0e0;
      margin-bottom: 10px;
      padding: 5px 15px;
      font-size: 14px;
    }

    .form-box input:focus {
      outline: none;
      background: #fff;
      border: 1px solid #0c1b45;
    }
  </style>

  <div class="container mt-4">
    <div class="row justify-content-center align-items-start g-4">
      <!-- Kamera -->
      <div class="col-md-5 text-center">
        <h4 class="fw-bold mb-3">Ambil Foto</h4>
        <video id="camera" autoplay playsinline width="100%" class="border rounded bg-dark"></video>
        <canvas id="canvas" width="320" height="240" class="d-none"></canvas>

        <div class="mt-3">
          <button id="captureBtn" class="camera me-2">
            <i class="bi bi-camera-fill"></i> Ambil
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
      <div class="col-md-6">
        <div class="kartu-perpus shadow">
          <!-- Header -->
          <div class="kartu-header">
            <img src="{{ asset('logo/logo.png') }}" alt="Logo Sekolah">
            <div>
              <div style="font-weight:bold;">KARTU KEANGGOTAAN PERPUSTAKAAN</div>
              <div>SMKS MAHAPUTRA CERDAS UTAMA</div>
            </div>
          </div>

          <!-- Isi -->
          <div class="kartu-body">
            <img id="preview" src="" class="foto-box rounded" alt="Foto" />

            <div class="form-box">
              <input type="text" placeholder="Nama Lengkap" id="nama" />
              <input type="text" placeholder="Kelas" id="kelas" />
              <input type="text" placeholder="NIS" id="nis" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
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
      })
      .catch(err => {
        cameraError.style.display = "block";
        console.error("Kamera error:", err);
      });

    // Ambil foto
    captureBtn.onclick = function () {
      const ctx = canvas.getContext("2d");
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
      const dataURL = canvas.toDataURL("image/png");
      preview.src = dataURL;
    };
  </script>
</x-app-layout>
