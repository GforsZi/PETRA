<!-- Modal for Confirmation Disconnect -->
<div class="modal fade" id="confirmDisconnectModal" tabindex="-1"
    aria-labelledby="confirmDisconnectLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDisconnectLabel">Confirm Disconnect</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="closeConfirmDisconnectModal()"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <p id="confirmDisconnectMessage">Are you sure you want to disconnect this device?
                </p>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    onclick="disconnectDeviceConfirmed()">Disconnect</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="closeConfirmDisconnectModal()">Cancel</button>
            </div>

        </div>
    </div>
</div>
