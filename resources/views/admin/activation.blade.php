<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container text-center">
        <h3>Ambil Foto Profil</h3>

        <video id="camera" autoplay playsinline width="320" height="240"
            class="border rounded"></video>
        <canvas id="canvas" width="320" height="240" class="d-none"></canvas>
        <br>

        <button id="captureBtn" class="btn btn-primary mt-2">Ambil Gambar</button>
        <button id="uploadBtn" class="btn btn-success mt-2 d-none">Simpan Gambar</button>

        <img id="preview" src="" class="mt-3 rounded" style="display:none;" />

        <form id="uploadForm" method="POST" enctype="multipart/form-data" style="display:none;">
            @csrf
            <input type="hidden" name="image" id="imageInput">
        </form>
    </div>

    <script>
        const video = document.getElementById('camera');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const uploadBtn = document.getElementById('uploadBtn');
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');

        // Aktifkan kamera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert('Tidak dapat mengakses kamera: ' + err);
            });

        // Ambil gambar
        captureBtn.onclick = function() {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            preview.src = dataURL;
            preview.style.display = 'block';
            imageInput.value = dataURL;
            uploadBtn.classList.remove('d-none');
        };

        // Upload ke server
        uploadBtn.onclick = async function() {
            const formData = new FormData(document.getElementById('uploadForm'));
            const response = await fetch('{{ route('profile.activation') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const result = await response.json();
            alert(result.message);
        };
    </script>
</x-app-layout>
