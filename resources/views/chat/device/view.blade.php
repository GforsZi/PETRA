<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/manage/chat/device/add" class="btn btn-outline-primary w-100">Tambah Perangkat
            Baru</a>
    </x-slot:header_layout>
    <!-- Toast Notification -->
    <div id="notification"
        class="toast align-items-center border-0 position-fixed bottom-0 z-3 end-0 m-3"
        role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">PETRA</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="d-flex">
            <div class="toast-body" id="notificationMessage">
                <!-- Pesan akan diisi lewat JS -->
            </div>
        </div>
    </div>

    <x-table_data :paginator="$devices_pg">
        <x-slot:title>Manage device</x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Quota</th>
            <th>Status</th>
            <th style="width: 30px">Actions</th>
        </x-slot:header>
        @forelse ($devices as $index => $device)
            <tr class="align-middle">
                <td>{{ $index + 1 }}</td>
                <td>{{ $device['name'] }}</td>
                <td>{{ $device['device'] }}</td>
                <td>{{ $device['quota'] }}</td>
                <td>
                    @if ($device['status'] === 'connect')
                        <span class="text-success">
                            Connected
                        </span>
                    @else
                        <span class="text-danger">
                            Disconnect
                        </span>
                    @endif
                </td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li> <button class="dropdown-item"
                                    onclick="copyToClipboard('{{ $device['token'] }}')">
                                    Copy Token
                                </button>
                            </li>
                            @if ($device['status'] === 'connect')
                                <!-- Send Message -->
                                <li>
                                    <button class="dropdown-item"
                                        onclick="openSendMessageModal('{{ $device['token'] }}')">
                                        Send Message
                                    </button>
                                </li>

                                <!-- Disconnect -->
                                <li>

                                    <button class="dropdown-item disconnectButton"
                                        data-device-token="{{ $device['token'] }}"
                                        onclick="disconnectDevice('{{ $device['token'] }}', this)">
                                        Disconnect
                                    </button>
                                </li>
                            @else
                                <!-- Connect -->
                                <button class="dropdown-item disconnectButton"
                                    data-device-token="{{ $device['token'] }}"
                                    onclick="activateDevice('{{ $device['token'] }}', this)">
                                    Connect
                                </button>
                            @endif
                            <li> <button class="dropdown-item"
                                    onclick="confirmDelete('{{ $device['token'] }}', '{{ $device['name'] }}')">
                                    Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>

                {{-- <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="/manage/chat/device/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item" href="/manage/chat/device/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation{{ $devices->firstItem() + $index }}">Hapus</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade"
                        id="deleteConfirmation{{ $devices->firstItem() + $index }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $devices->firstItem() + $index }}Label"
                        aria-hidden="true">
                        <form action="/system/device/{{ $device->dvc_id }}/delete" method="post"
                            class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin menghapus data ini?
                                        {{ $devices->firstItem() + $index }}.</p>
                                </div>
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button"
                                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit"
                                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Hapus</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="6" class="w-100 text-center">404 | Data tidak ditemukan</td>
            </tr>
        @endforelse
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        @include('chat.device.partials.modal-qr-code')

    </x-table_data>
    @include('chat.device.partials.modal-device-details')
    @include('chat.device.partials.modal-confirmation-delete')
    @include('chat.device.partials.modal-confirmation-disconnect')
    @include('chat.device.partials.modal-otp-delete')
    @include('chat.device.partials.modal-send-message')
    @include('chat.device.partials.script')

</x-app-layout>
