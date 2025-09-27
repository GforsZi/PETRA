<div class="modal fade" id="otpDeleteAuthorization" tabindex="-1" aria-labelledby="otpDeleteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="otpDeleteLabel">Otorisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="deviceIdToDelete=null;"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <p id="confirmDeleteMessage">
                    Please insert the OTP code that was sent to your registered number.
                </p>

                <!-- Error Message -->
                <div id="errorContainerOTP" class="alert alert-danger d-none">
                    <span id="errorMessageOTP"></span>
                </div>

                <!-- Form -->
                <form id="otpAuthorizationForm"
                    onsubmit="event.preventDefault(); deleteDevice(document.getElementById('otpInput').value);">
                    <input type="text" id="otpInput" name="otp" class="form-control"
                        placeholder="Enter OTP" required />
                </form>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="submit" form="otpAuthorizationForm" class="btn btn-danger">
                    Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    onclick="deviceIdToDelete=null;">
                    Cancel
                </button>
            </div>

        </div>
    </div>
</div>
