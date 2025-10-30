<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-4 ">
        <div class="card-header">
            <h3 class="card-title">Detail Klasifikasi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Isi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle">
                            <td>ID Klasifikasi</td>
                            <td>{{ $classfication['ddc_id'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Code Klasifikasi</td>
                            <td>{{ $classfication['ddc_code'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Keterangan Klasifikasi</td>
                            <td>{{ $classfication['ddc_description'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dibuat oleh</td>
                            <td>{{ $classfication['created_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Diubah oleh</td>
                            <td>{{ $classfication['updated_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dihapus oleh</td>
                            <td>{{ $classfication['deleted_by']['name'] ?? '' }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dibuat Pada</td>
                            <td>{{ $classfication['ddc_created_at'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Diubah pada</td>
                            <td>{{ $classfication['ddc_updated_at'] }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td>Dihapus pada</td>
                            <td>{{ $classfication['ddc_deleted_at'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
