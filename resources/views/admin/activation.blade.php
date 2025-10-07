<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>


    <style>
    /* From Uiverse.io by Botwe-Felix5820 */ 
.camera {
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

.camera:hover {
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

</style>
<div class="container text-center mt-4">
  <div class="custom-card p-4 shadow-sm rounded">
    <h3 class="fw-bold text-xl mb-3">Ambil Foto untuk kartu </h3>

    <div class="row justify-content-center align-items-center">
      <!-- Kamera di kiri -->
      <div class="col-md-6 mb-3 mb-md-0">
        <div class="position-relative d-inline-block w-100" style="max-width: 400px;">
          <!-- Video Kamera -->
          <video id="camera" autoplay playsinline width="100%" height="auto"
            class="border rounded w-100 bg-dark"></video>

          <!-- Overlay Gridlines -->
          <div class="position-absolute top-0 start-0 w-100 h-100"
            style="pointer-events:none;">
            <svg width="100%" height="100%">
              <!-- Garis Vertikal -->
              <line x1="33.33%" y1="0" x2="33.33%" y2="100%" stroke="rgba(255,255,255,0.6)" stroke-width="1"/>
              <line x1="66.66%" y1="0" x2="66.66%" y2="100%" stroke="rgba(255,255,255,0.6)" stroke-width="1"/>
              <!-- Garis Horizontal -->
              <line x1="0" y1="33.33%" x2="100%" y2="33.33%" stroke="rgba(255,255,255,0.6)" stroke-width="1"/>
              <line x1="0" y1="66.66%" x2="100%" y2="66.66%" stroke="rgba(255,255,255,0.6)" stroke-width="1"/>
            </svg>
          </div>
        </div>

        <canvas id="canvas" width="320" height="240" class="d-none"></canvas>

        <div class="mt-3">
           <button id="captureBtn" class="camera btn btn-primary me-2">
            <i class="bi bi-camera-fill"></i>
          </button>
          <button id="uploadBtn" class="btn btn-success d-none" disabled>
            <i class="bi bi-bookmark-check-fill"></i> Simpan Gambar
          </button>
        </div>

        <p id="cameraError" class="text-danger mt-2" style="display:none;">
          ❌ Kamera tidak dapat diakses. Pastikan browser mengizinkan penggunaan kamera.
        </p>
      </div>

      <!-- Hasil foto di kanan -->
      <div class="col-md-6">
        <div class="d-flex justify-content-center">
          <img id="preview" src="" 
            class="mt-3 mt-md-0 rounded border shadow-sm"
            style="display:none; width:120px; height:160px; object-fit:cover;" />
        </div>
        <p class="mt-2 text-muted" id="previewLabel" style="display:none;">Hasil Foto</p>
      </div>
    </div>

    <form id="uploadForm" method="POST" enctype="multipart/form-data" style="display:none;">
      @csrf
      <input type="hidden" name="image" id="imageInput">
    </form>
  </div>
</div>

<script>
  const video = document.getElementById('camera');
  const canvas = document.getElementById('canvas');
  const captureBtn = document.getElementById('captureBtn');
  const uploadBtn = document.getElementById('uploadBtn');
  const imageInput = document.getElementById('imageInput');
  const preview = document.getElementById('preview');
  const previewLabel = document.getElementById('previewLabel');
  const cameraError = document.getElementById('cameraError');

  // Fungsi untuk nonaktifkan tombol
  function disableCameraControls() {
    captureBtn.disabled = true;
    uploadBtn.disabled = true;
  }

  function enableCameraControls() {
    captureBtn.disabled = false;
  }

  // Coba aktifkan kamera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
      video.srcObject = stream;
      enableCameraControls(); // Aktifkan tombol jika kamera berhasil
    })
    .catch(err => {
      cameraError.style.display = 'block';
      disableCameraControls(); // Nonaktifkan tombol jika gagal
      console.error('Kamera error:', err);
    });

  // Ambil gambar
  captureBtn.onclick = function() {
      if (captureBtn.disabled) return;
      const context = canvas.getContext('2d');
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
      const dataURL = canvas.toDataURL('image/png');
      preview.src = dataURL;
      preview.style.display = 'block';
      previewLabel.style.display = 'block';
      imageInput.value = dataURL;
      uploadBtn.classList.remove('d-none');
      uploadBtn.disabled = false;
  };

  // Upload ke server
  uploadBtn.onclick = async function() {
      if (uploadBtn.disabled) return;
      const formData = new FormData(document.getElementById('uploadForm'));
      const response = await fetch('{{ route('profile.activation') }}', {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          body: formData
      });

      const result = await response.json();
      alert(result.message);
  };
</script>
</x-app-layout>
