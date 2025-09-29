<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="row g-0 align-items-center">
        <div class="col-12 col-md-4 d-flex justify-content-center p-3">
            <img src="{{ asset($account['usr_img_url'] ?? '/logo/user_placeholder.jpg') }}"
                class="rounded-circle shadow object-fit-cover" alt="Profile Image" width="200"
                height="200">
        </div>
        <div class="card mb-4 col-12 col-md-8">
            <div class="card-header">
                <h3 class="card-title">Detail account</h3>
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
                                    Terblokir
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
                <form method="post" action="/system/account/{{ $account['usr_id'] }}/activate">
                    @csrf
                    @method('PUT')
                    <input hidden name='usr_activation' value="1" />
                    <button type="submit" class="btn btn-primary">Aktifkan Akun</button>
                </form>
                <form method="post" action="/system/account/{{ $account['usr_id'] }}/ban">
                    @csrf
                    @method('PUT')
                    <input hidden name='usr_activation' value="0" />
                    <button type="submit" class="btn btn-warning">Blokir Akun</button>
                </form>
                <a class="btn btn-warning"
                    href="/manage/account/{{ $account['usr_id'] }}/edit">Ubah
                    Akun</a>
                <a class="btn btn-danger"style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation{{ $account['usr_id'] }}">Hapus Akun</a>

            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteConfirmation{{ $account['usr_id'] }}"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteConfirmation{{ $account['usr_id'] }}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered"
            action="/system/account/{{ $account['usr_id'] }}/delete">
            @csrf
            @method('DELETE')
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Delete this data?</h5>
                    <p class="mb-0">are you sure to delete user {{ $account['name'] }}.</p>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="button"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end"
                        data-bs-dismiss="modal">Cancle</button>
                    <input hidden value="{{ $account['usr_id'] }}" />
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>Submit</strong></button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
