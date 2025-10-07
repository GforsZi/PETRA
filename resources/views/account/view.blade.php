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
        <a href="/manage/account/add" class="btn btn-outline-primary w-100"><i class="bi bi-plus-lg"></i></a>
    </x-slot:header_layout>
    <x-table-data :paginator="$accounts">
        <x-slot:title></x-slot:title>
        <x-slot:header>
            <th style="width: 10px">#</th>
            <th style="width: 150px">photo profile</th>
            <th>username</th>
            <th>role</th>
            <th>activation</th>
            <th style="width: 60px">detail</th>
        </x-slot:header>
        @forelse ($accounts as $index => $account)
            <tr class="align-middle">
                <td>{{ $accounts->firstItem() + $index }}</td>
                <td>
                    <img src="{{ asset($account->usr_img_url ?? '/logo/user_placeholder.jpg') }}"
                        class="rounded-circle shadow object-fit-cover" width="50" height="50"
                        alt="User Image" />
                </td>
                <td>{{ $account->name }}</td>
                <td>{{ $account->roles->rl_name ?? 'not have' }}</td>
                <td>
                    @if ($account->usr_activation)
                        already activated
                    @else
                        not activated
                    @endif
                </td>
                <td>
                    <div class="dropdown dropstart">
                        <button class="btn btn-warning dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-menu-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="/manage/account/{{ $account->usr_id }}/detail">Detail</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="/manage/account/{{ $account->usr_id }}/edit">Ubah</a>
                            </li>
                            <li><a class="dropdown-item" style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation{{ $accounts->firstItem() + $index }}">Hapus</a>
                            </li>
                            <li>
                                <a class="dropdown-item" style="cursor: pointer;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#chatConfirmation{{ $accounts->firstItem() + $index }}">Kirim pesan</a></a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade"
                        id="deleteConfirmation{{ $accounts->firstItem() + $index }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="deleteConfirmation{{ $accounts->firstItem() + $index }}Label"
                        aria-hidden="true">
                        <form action="/system/account/{{ $account->usr_id }}/delete" method="post"
                            class="modal-dialog modal-dialog-centered">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content rounded-3 shadow">
                                <div class="modal-body p-4 text-center">
                                    <h5 class="mb-0">Konfirmasi</h5>
                                    <p class="mb-0">Yakin ingin menghapus data ini?
                                        {{ $accounts->firstItem() + $index }}.</p>
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
                    <div class="modal fade"
                        id="chatConfirmation{{ $accounts->firstItem() + $index }}"
                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="chatConfirmation{{ $accounts->firstItem() + $index }}Label"
                        aria-hidden="true">
                        <form action="/system/account/{{ $account->usr_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                            @csrf
                            <div class="modal-content rounded-4 border-success border-2">
                                <div class="modal-header bg-success text-white rounded-top-4">
                                    <h5 class="modal-title"><i class="bi bi-whatsapp"></i> Kirim Pesan WhatsApp</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Nomor Tujuan</label>
                                    <input type="text" value="{{ $account->usr_no_wa }}" class="form-control mb-3" readonly>

                                    <label class="form-label">Isi Pesan</label>
                                    <textarea class="form-control" rows="3" placeholder="Tulis pesan untuk pengguna ini..."></textarea>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Kirim</button>
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
</x-app-layout>
