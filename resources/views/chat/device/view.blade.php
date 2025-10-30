<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <x-slot:header_layout>
        <a href="/manage/chat/device/add" class="btn btn-lg btn-outline-primary w-100" title="Tambahkan Perangkat"><i class="bi bi-whatsapp"></i></a>
    </x-slot:header_layout>
    <!-- Toast Notification -->
    <div id="notification" class="toast align-items-center border-0 position-fixed bottom-0 z-3 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">PETRA</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="d-flex">
            <div class="toast-body" id="notificationMessage">
                <!-- Pesan akan diisi lewat JS -->
            </div>
        </div>
    </div>

    <x-table_data :paginator="$devices_pg">
        <x-slot:title>
        </x-slot:title>
        <x-slot:header>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Nomor</th>
            <th>Kuota</th>
            <th>Status</th>
            <th style="width: 30px"></th>
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
                            Terhubung
                        </span>
                    @else
                        <span class="text-danger">
                            Terputus
                        </span>
                    @endif
                </td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            @if ($device['status'] === 'connect')
                                <!-- Send Message -->
                                <li>
                                    <button class="dropdown-item" onclick="openSendMessageModal('{{ $device['token'] }}')">
                                        Kirim pesan
                                    </button>
                                </li>

                                <!-- Disconnect -->
                                <li>

                                    <button class="dropdown-item disconnectButton" data-device-token="{{ $device['token'] }}" onclick="disconnectDevice('{{ $device['token'] }}', this)">
                                        Putuskan
                                    </button>
                                </li>
                            @else
                                <!-- Connect -->
                                <button class="dropdown-item disconnectButton" data-device-token="{{ $device['token'] }}" onclick="activateDevice('{{ $device['token'] }}', this)">
                                    Hubungkan
                                </button>
                            @endif
                            <li> <button class="dropdown-item" onclick="confirmDelete('{{ $device['token'] }}', '{{ $device['name'] }}')">
                                    Hapus
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
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
