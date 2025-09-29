<script>
    let deviceIdToDelete = null;

    function activateDevice(deviceToken, buttonElement) {
        // Cari modal Bootstrap
        const modalEl = document.getElementById('qrCodeModal');
        const modalBody = modalEl.querySelector('.qroutput');
        const modalInstance = new bootstrap.Modal(modalEl);

        // Set loading text dulu
        modalBody.innerHTML = '<p class="text-center">Loading...</p>';
        modalInstance.show();

        // Fetch request
        fetch('{{ route('devices.activate') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    token: deviceToken
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    const qrImage =
                        `<img src="data:image/png;base64,${data.url}" alt="QR Code" class="img-fluid">`;
                    modalBody.innerHTML = qrImage;
                } else {
                    modalBody.innerHTML = `<p class="text-danger">Error: ${data.error}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modalBody.innerHTML =
                    '<p class="text-danger">An error occurred while activating the device.</p>';
            });
    }


    function showModal() {
        const modal = document.getElementById('deviceModal');
        modal.classList.remove('d-none');
    }

    function disconnectDevice(deviceToken) {
        const disconnectButton = document.querySelector(
            `.disconnectButton[data-device-token="${deviceToken}"]`);
        const disconnectSpinner = disconnectButton.querySelector('.disconnectSpinner');

        disconnectButton.disabled = true;
        disconnectSpinner.classList.remove('d-none');

        fetch('{{ route('devices.disconnect') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    token: deviceToken
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert('Device successfully disconnected.');
                    location.reload();
                } else if (data.error) {
                    alert('Failed to disconnect device: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while disconnecting the device.');
            });
    }

    let confirmDeleteModal = null;
    let otpDeleteModal = null;

    document.addEventListener("DOMContentLoaded", () => {
        confirmDeleteModal = new bootstrap.Modal(document.getElementById(
            'confirmDeleteModal'));
        otpDeleteModal = new bootstrap.Modal(document.getElementById(
            'otpDeleteAuthorization'));
    });

    function confirmDelete(deviceId, deviceName) {
        deviceIdToDelete = deviceId;
        document.getElementById('confirmDeleteMessage').innerText =
            `Are you sure you want to delete the device "${deviceName}"?`;
        confirmDeleteModal.show();
    }

    function closeConfirmDeleteModal() {
        confirmDeleteModal.hide();
        deviceIdToDelete = null;
    }

    function deleteDevice(otp = null) {
        const errorContainer = document.getElementById('errorContainerOTP');
        const errorMessage = document.getElementById('errorMessageOTP');

        errorContainer.classList.add('d-none');

        // Jika user submit OTP
        if (otp) {
            axios.post('/system/chat/' + deviceIdToDelete, {
                '_token': "{{ csrf_token() }}",
                '_method': "DELETE",
                'otp': otp
            }).then((response) => {
                otpDeleteModal.hide();
                deviceIdToDelete = null;
                window.location.reload();
            }).catch((error) => {
                errorMessage.textContent = error.response.data.error;
                errorContainer.classList.remove('d-none');
            });
            return;
        }

        // Step pertama: setelah klik Delete → tutup confirm, buka OTP
        if (deviceIdToDelete) {
            confirmDeleteModal.hide();
            otpDeleteModal.show();

            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('_method', "DELETE");

            fetch('/system/chat/' + deviceIdToDelete, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(result => console.log(result))
                .catch(error => console.error('Error:', error));

            return;
        }
    }

    let sendMessageModal = null;

    function openSendMessageModal(deviceToken) {
        const modalEl = document.getElementById('sendMessageModal');
        sendMessageModal = new bootstrap.Modal(modalEl);

        sendMessageModal.show();
        document.getElementById('deviceToken').value = deviceToken;
        clearError();
    }

    function closeSendMessageModal() {
        sendMessageModal.hide();
        clearError();

    }

    function closeOtpDeleteAuthorization() {
        document.getElementById('otpDeleteAuthorization').classList.add('d-none');
        clearError();
    }

    function clearError() {
        const errorContainer = document.getElementById('errorContainer');
        const errorMessage = document.getElementById('errorMessage');
        errorContainer.classList.add('d-none');
        errorMessage.textContent = '';
    }

    document.getElementById('otpAuthorizationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        deleteDevice(formData.get('otp'))
    })

    document.getElementById('sendMessageForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        const deviceToken = formData.get('device_token');
        const sendButton = document.getElementById('sendMessageButton');
        const buttonText = document.getElementById('buttonText');
        const spinner = document.getElementById('spinner');

        buttonText.textContent = 'Sending...';
        spinner.classList.remove('d-none');
        sendButton.disabled = true;

        try {
            const response = await fetch('/system/chat/send_message', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Authorization': deviceToken,
                },
                body: formData,
            });

            const result = await response.json();

            if (response.ok) {
                alert('Pesan berhasil dikirim!');
                closeSendMessageModal();
            } else {
                showError(result.error || 'Gagal mengirim pesan.');
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Terjadi kesalahan. Coba lagi.');
        } finally {
            buttonText.textContent = 'Send';
            spinner.classList.add('d-none');
            sendButton.disabled = false;
        }
    });

    function showSuccess(message) {
        const messageContainer = document.getElementById('messageAlert');
        messageContainer.innerHTML =
            `<div class="alert alert-success mb-3" role="alert">${message}</div>`;
    }

    function showError(message) {
        const errorContainer = document.getElementById('errorContainer');
        const errorMessage = document.getElementById('errorMessage');
        errorMessage.textContent = message;
        errorContainer.classList.remove('d-none');
    }

    function copyToClipboard(token) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(token).then(() => {
                showNotification(token);
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        } else {
            const textArea = document.createElement("textarea");
            textArea.value = token;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showNotification(token);
            } catch (err) {
                console.error('Fallback: Failed to copy', err);
            }
            document.body.removeChild(textArea);
        }
    }

    function showNotification(token) {
        const notification = document.getElementById('notification');
        const notificationMessage = document.getElementById('notificationMessage');

        if (notification && notificationMessage) {
            notificationMessage.innerText = 'Token copied to clipboard: ' + token;

            // Inisialisasi dan tampilkan Bootstrap Toast
            const toast = new bootstrap.Toast(notification, {
                delay: 2000
            });
            toast.show();
        }
    }
</script>
