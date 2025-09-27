<!-- Modal QR Code -->
<div id="qrCodeModal" class="modal fade" tabindex="-1" aria-hidden="true" x-show="isOpen" x-cloak>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <!-- Keterangan di bagian atas modal -->
                <p class="fs-5 fw-bold text-center mb-4">Cara menggunakan Whatsapp di PETRA:</p>
                <ol class="text-muted small mb-4 text-wrap">
                    <li>
                        Buka WhatsApp di ponsel Anda</li>
                    <li>klik Menu atau Pengaturan dan pilih Perangkat Tertaut</li>
                    <li>Arahkan ponsel Anda ke layar ini untuk menangkap kode</li>
                    <li>Setelah ponsel cerdas Anda menampilkan pesan sukses, refresh halaman ini
                        dan
                        perangkat Anda akan siap mengirim pesan.</li>
                </ol>

                <!-- QR Code atau loading message -->
                <div class="text-center mb-3 qroutput">
                    <span x-text="loading ? 'Loading...' : ''"></span>
                </div>
                <div x-show="qrCode" x-html="qrCode" class="d-flex justify-content-center mb-3">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" @click="isOpen = false; qrCode = '';"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
