<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-4 ">
        <div class="card-header">
            <h3 class="card-title">Detail Opsi Chat</h3>
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
                        <td>ID Opsi</td>
                        <td>{{ $option['cht_opt_id'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Judul</td>
                        <td>{{ $option['cht_opt_title'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Pesan</td>
                        <td>{{ $option['cht_opt_message'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Tipe</td>
                        <td>
                            @if ($option['cht_opt_type'] == '1')
                                Pemberitahuan aktifasi
                            @elseif ($option['cht_opt_type'] == '2')
                                Peringatan waktu peminjaman
                            @else
                                Pesan bantuan
                            @endif
                        </td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dibuat oleh</td>
                        <td>{{ $option['created_by']['name'] ?? '' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Diubah oleh</td>
                        <td>{{ $option['updated_by']['name'] ?? '' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dihapus oleh</td>
                        <td>{{ $option['deleted_by']['name'] ?? '' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dibuat Pada</td>
                        <td>{{ $option['cht_opt_created_at'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Diubah pada</td>
                        <td>{{ $option['cht_opt_updated_at'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dihapus pada</td>
                        <td>{{ $option['cht_opt_deleted_at'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
