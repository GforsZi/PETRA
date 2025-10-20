<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="row g-0">
        <div class="col-12 col-md-4 d-flex justify-content-center p-3">
            <img src="{{ asset($account['usr_card_url'] ?? '/logo/user_placeholder.jpg') }}"
                class="rounded-circle shadow object-fit-cover" alt="Profile Image" width="200"
                height="200">
        </div>
        <div class="card mb-4 col-12 col-md-8">
            <div class="card-header">
                <h3 class="card-title">Detail Akun</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>Nama</td>
                            <td>{{ $account['name'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>No Whatsapp</td>
                            <td>{{ $account['usr_no_wa'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Peran</td>
                            <td>{{ $account['roles']['rl_name'] ?? 'not have' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Aktivasi</td>
                            <td>
                                @if ($account['usr_activation'])
                                    Sudah teraktivasi
                                @else
                                    Belum teraktivasi
                                @endif
                            </td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dibuat oleh</td>
                            <td>{{ $account['created_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Diubah oleh</td>
                            <td>{{ $account['updated_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dihapus oleh</td>
                            <td>{{ $account['deleted_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dibuat Pada</td>
                            <td>{{ $account['usr_created_at'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Diubah pada</td>
                            <td>{{ $account['usr_updated_at'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dihapus pada</td>
                            <td>{{ $account['usr_deleted_at'] ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="d-flex m-2 gap-2">
                @if (auth()->user()->usr_id != $account['usr_id'])
                    @if ($account['usr_activation'])
                        <a class="btn btn-lg btn-warning" style="cursor: pointer;"
                            title="Nonaktifkan akun" data-bs-toggle="modal"
                            data-bs-target="#banConfirmation{{ $account['usr_id'] }}"><i
                                class="bi bi-ban"></i></a>
                    @else
                        <a class="btn btn-lg btn-success" style="cursor: pointer;"
                            title="Aktifasi akun" data-bs-toggle="modal"
                            data-bs-target="#activationConfirmation{{ $account['usr_id'] }}"><i
                                class="bi bi-check2-all"></i></a>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="banConfirmation{{ $account['usr_id'] }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="banConfirmation{{ $account['usr_id'] }}Label" aria-hidden="true">
        <form action="/system/account/{{ $account['usr_id'] }}/ban" method="post"
            class="modal-dialog modal-dialog-centered">
            @csrf
            @method('PUT')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Konfirmasi</h5>
                    <p class="mb-0">Yakin ingin menghapus data ini ?</p>
                </div>
                <input hidden name='usr_activation' value="0" />
                <div class="alert mx-4 mt-4 alert-warning d-flex text-start align-items-center"
                    role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div class="text-wrap">
                        Jika akun dinonaktifkan maka pengguna akun ini tidak dapat mengakses
                        aplikasi.
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Ya</strong></button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="activationConfirmation{{ $account['usr_id'] }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="activationConfirmation{{ $account['usr_id'] }}Label" aria-hidden="true">
        <form action="/system/account/{{ $account['usr_id'] }}/activate" method="post"
            class="modal-dialog modal-dialog-centered">
            @csrf
            @method('PUT')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Konfirmasi</h5>
                    <p class="mb-0">Yakin ingin melakukan aktifasi pada akun ini ?</p>
                </div>
                <input hidden name='usr_activation' value="1" />
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Ya</strong></button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
