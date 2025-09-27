<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeConfirmDeleteModal()"></button>
            </div>

            <div class="modal-body">
                <p id="confirmDeleteMessage">Are you sure you want to delete this device?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    onclick="deleteDevice()">Delete</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="closeConfirmDeleteModal()">Cancel</button>
            </div>

        </div>
    </div>
</div>
