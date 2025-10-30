<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeConfirmDeleteModal()"></button>
            </div>

            <div class="modal-body">
                <p id="confirmDeleteMessage">Yakin ingin menghapus nomor ini?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deleteDevice()">Hapus</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeConfirmDeleteModal()">Tidak</button>
            </div>

        </div>
    </div>
</div>
