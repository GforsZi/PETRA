<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>{{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/manage/account/add" class="btn btn-lg btn-outline-primary" title="Tambah Akun Baru"><i class="bi bi-plus-lg"></i></a>
        <a class="btn btn-lg btn-outline-success" style="cursor: pointer;" title="Cetak Kartu" data-bs-toggle="modal" data-bs-target="#printCardModal"><i class="bi bi-printer-fill"></i></a>
    </x-slot:header_layout>
    <!-- Modal Print Card -->
    <div class="modal fade" id="printCardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="printCardModalLabel" aria-hidden="true">
        <form action="/system/print/card" method="post" class="modal-dialog modal-dialog-centered">
            @csrf
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-3">Pilih Peran</h5>
                    <p class="text-muted mb-3">Silakan pilih satu atau beberapa role yang ingin
                        dicetak kartunya.</p>

                    <div class="mb-3 text-start">
                        <label for="role" class="form-label fw-semibold">Role</label>
                        <select name="role[]" id="role" class="form-select" multiple required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->rl_id }}">{{ $role->rl_name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Tekan Ctrl (atau Command di Mac) untuk memilih
                            lebih dari satu.</small>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" onclick="this.disabled=true; this.form.submit();">
                        <strong>Print</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <x-table-data :paginator="$accounts">
        <x-slot:title>
            <form class="d-flex" role="search" method="get" action="/manage/account">
                <input class="form-control me-2" name="s" value="{{ request('s') }}" type="search" placeholder="Masukan Nama Pengguna" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">No</th>
            <th style="width: 150px">Foto Profil</th>
            <th>Nama Lengkap</th>
            <th>Peran</th>
            <th>Aktifasi</th>
            <th style="width: 60px"> </th>
        </x-slot:header>
        @forelse ($accounts as $index => $account)
            <tr class="align-middle">
                <td>{{ $accounts->firstItem() + $index }}</td>
                <td>
                    <img src="{{ asset($account->usr_card_url ?? '/logo/user_placeholder.jpg') }}" class="rounded-circle shadow object-fit-cover" width="50" height="50" alt="User Image" />
                </td>
                <td>{{ $account->name }}</td>
                <td>{{ $account->roles->rl_name ?? '' }}</td>
                <td>
                    @if ($account->usr_activation)
                        Sudah Teraktifasi
                    @else
                        Belum Teraktifasi
                    @endif
                </td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#chatConfirmation{{ $accounts->firstItem() + $index }}">Kirim
                                    pesan</a></a>
                            </li>
                            <li><a class="dropdown-item" href="/manage/account/{{ $account->usr_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item" href="/manage/account/{{ $account->usr_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $accounts->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade" id="deleteConfirmation{{ $accounts->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $accounts->firstItem() + $index }}Label" aria-hidden="true">
                        <form action="/system/account/{{ $account->usr_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin menghapus data ini ?</p>
                                </div>
                                <div class="alert mx-4 mt-4 alert-warning d-flex text-start align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    <div class="text-wrap">
                                        Penghapusan ini bersifat <strong>tidak permanen
                                            </strong> — data masih dapat
                                        dipulihkan dari halaman riwayat.
                                    </div>
                                </div>
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Hapus</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade" id="roleConfirmation{{ $accounts->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="roleConfirmation{{ $accounts->firstItem() + $index }}Label" aria-hidden="true">
                        <form action="/system/account/{{ $account->usr_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin menghapus data ini?
                                        {{ $accounts->firstItem() + $index }}.</p>
                                </div>
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Hapus</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal fade" id="chatConfirmation{{ $accounts->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="chatConfirmation{{ $accounts->firstItem() + $index }}Label" aria-hidden="true">
                        <form id="sendMessageForm" class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-success border-2">
                                <div class="modal-header  bg-success text-white rounded-top-4">
                                    <h5 class="modal-title"><i class="bi bi-whatsapp"></i> Kirim
                                        Pesan WhatsApp</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div id="errorContainer" class="alert mt-2 alert-danger d-none" role="alert">
                                    <p class="mb-0" id="errorMessage"></p>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Nomor Tujuan</label>
                                    <input type="text" name="target" id="target" required value="{{ $account->usr_no_wa }}" class="form-control mb-3" readonly>

                                    <label class="form-label">Isi Pesan</label>
                                    <textarea id="message" required name="message" class="form-control" rows="3" placeholder="Tulis pesan untuk pengguna ini..."></textarea>
                                    <input type="hidden" name="device_token" value="{{ $activeDeviceToken }}">
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" id="sendMessageButton" class="btn btn-success"><i class="bi bi-send"></i> <span id="buttonText">Kirim</span>
                                        <div id="spinner" class="spinner-border spinner-border-sm text-light ms-2 d-none" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="w-100 text-center">404 | Data tidak ditemukan</td>
            </tr>
        @endforelse
    </x-table-data>
    <script>
        document.querySelectorAll('form#sendMessageForm').forEach(form => {
            form.addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const deviceToken = formData.get('device_token');
                const sendButton = this.querySelector('#sendMessageButton');
                const buttonText = this.querySelector('#buttonText');
                const spinner = this.querySelector('#spinner');

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
                        const modalEl = bootstrap.Modal.getInstance(this.closest(
                            '.modal'));
                        modalEl.hide();
                    } else {
                        showError(result.error || 'Gagal mengirim pesan.', this);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showError('Terjadi kesalahan. Coba lagi.', this);
                } finally {
                    buttonText.textContent = 'Kirim';
                    spinner.classList.add('d-none');
                    sendButton.disabled = false;
                }
            });
        });

        function showError(message, context) {
            const errorContainer = context.querySelector('#errorContainer');
            const errorMessage = context.querySelector('#errorMessage');
            errorMessage.textContent = message;
            errorContainer.classList.remove('d-none');
        }
    </script>
</x-app-layout>
