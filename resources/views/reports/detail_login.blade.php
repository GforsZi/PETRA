<x-app-layout>
    <x-slot:title>Detail Login</x-slot:title>
    <x-slot:header_layout>
        <a href="/manage/export/statistics/{{ $date }}/pdf" class="btn btn-outline-success"><i class="bi bi-file-earmark-excel"></i>
            Export PDF</a>
    </x-slot:header_layout>
    <div class="card mb-4 w-100">
        <div class="card-header">
            <h3 class="card-title">Riwayat login Akun</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <!-- Tambahan satu baris ini aja -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pengguna</th>
                            <th>Ip address</th>
                            <th>Detail Perangkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logins as $userlogin)
                            <tr class="align-middle">
                                <td>{{ $userlogin->usr_lg_logged_in_at }}</td>
                                <td>{{ $userlogin->user->name ?? '' }}</td>
                                <td>{{ $userlogin->usr_lg_ip_address }}</td>
                                <td>{{ $userlogin->usr_lg_user_agent }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
