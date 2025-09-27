<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
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
                        <td>ID Penulis</td>
                        <td>{{ $author['athr_id'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Nama Penulis</td>
                        <td>{{ $author['athr_name'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dibuat oleh</td>
                        <td>{{ $author['created_by']['name'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Diubah oleh</td>
                        <td>{{ $author['updated_by']['name'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dihapus oleh</td>
                        <td>{{ $author['deleted_by']['name'] ?? '' }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dibuat Pada</td>
                        <td>{{ $author['athr_created_at'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Diubah pada</td>
                        <td>{{ $author['athr_updated_at'] }}</td>
                    </tr>
                    <tr class="align-middle">
                        <td>Dihapus pada</td>
                        <td>{{ $author['athr_deleted_at'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
