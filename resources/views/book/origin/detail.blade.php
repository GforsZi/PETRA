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
            <h3 class="card-title">Detail author</h3>
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
                        <td>ID Jurusan</td>
                        <td>{{ $origin['bk_orgn_id'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Pemberi</td>
                        <td>{{ $origin['bk_orgn_name'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Keterangan</td>
                        <td>{{ $origin['bk_orgn_description'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dibuat oleh</td>
                        <td>{{ $origin['created_by']['name'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Diubah oleh</td>
                        <td>{{ $origin['updated_by']['name'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dihapus oleh</td>
                        <td>{{ $origin['deleted_by']['name'] ?? '' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dibuat Pada</td>
                        <td>{{ $origin['bk_orgn_created_at'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Diubah pada</td>
                        <td>{{ $origin['bk_orgn_updated_at'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dihapus pada</td>
                        <td>{{ $origin['bk_orgn_deleted_at'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
