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
                    <button type="submit" class="btn btn-lg btn-success" title="Aktifkan Akun"><i
                            class="bi bi-check2-all"></i></button>
                </form>
                <form method="post" action="/system/account/{{ $account['usr_id'] }}/ban">
                    @csrf
                    @method('PUT')
                    <input hidden name='usr_activation' value="0" />
                    <button type="submit" class="btn btn-lg btn-warning"
                        title="Nonaktifkan Akun"><i class="bi bi-ban"></i></button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
