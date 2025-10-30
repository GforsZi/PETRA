<!-- Modal -->
<div id="sendMessageModal" class="modal fade" tabindex="-1" aria-hidden="true" x-show="isOpen" x-cloak>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Kirim pesan</h5>
                <button type="button" class="btn-close" aria-label="Close" onclick="closeSendMessageModal()"></button>
            </div>

            <div class="modal-body">
                <!-- Error message container -->
                <div id="errorContainer" class="alert alert-danger d-none" role="alert">
                    <p class="mb-0" id="errorMessage"></p>
                </div>

                <form id="sendMessageForm">
                    <div class="mb-3">
                        <label for="target" class="form-label">Tujuan</label>
                        <input type="text" name="target" id="target" required class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea name="message" id="message" rows="4" required class="form-control"></textarea>
                    </div>

                    <input type="hidden" name="device_token" id="deviceToken">

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-danger" onclick="closeSendMessageModal()">Batal</button>

                        <button type="submit" class="btn btn-success d-flex align-items-center" id="sendMessageButton">
                            <span id="buttonText">Kirim</span>
                            <div id="spinner" class="spinner-border spinner-border-sm text-light ms-2 d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
