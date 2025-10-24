<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Error: {{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($histories)
        <x-table_data :paginator="$histories">
            <x-slot:title></x-slot:title>
            <x-slot:header>
                <th style="width: 10px">#</th>
                <th>Atribut</th>
                <th>Dihapus Pada</th>
                <th style="width: 50px">Pilihan</th>
            </x-slot:header>
            @forelse ($histories as $index => $history)
                <tr class="align-middle">
                    <td>{{ $histories->firstItem() + $index }}</td>
                    <td>{{ $history->title }}</td>
                    <td>{{ $history->deleted_at }}</td>
                    <td>
                        <div class="dropdown dropstart">
                            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-menu-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ $page_url . '/' . $history->id . '/detail' }}">Detail</a>
                                </li>
                                <li>
                                    <form action="/system/restore/{{ $history->id }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="{{ request()->query('category') }}" name="model">
                                        <button class="dropdown-item" type="submit" onclick="this.disabled=true; this.form.submit();">Pulihkan
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="modal fade" id="deleteConfirmation{{ $histories->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="deleteConfirmation{{ $histories->firstItem() + $index }}Label" aria-hidden="true">
                            <form action="/history/{{ $history->id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content rounded-3 shadow">
                                    <div class="modal-body p-4 text-center">
                                        <h5 class="mb-0">Hapus data ini?</h5>
                                        <p class="mb-0">Apakah anda yakin untuk menghapus data ini?
                                            {{ $histories->firstItem() + $index }}.</p>
                                    </div>
                                    <div class="modal-footer flex-nowrap p-0">
                                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button>
                                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                                            onclick="this.disabled=true; this.form.submit();"><strong>Delete</strong></button>
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
        </x-table_data>
    @else
        <div class="container">
            <div class="row w-100">
                @foreach ($pages as $page)
                    <div class="col-sm-4 my-4">
                        <div class="card shadow-sm border-0 rounded-4 h-100 d-flex flex-row">
                            <div class="d-flex align-items-center justify-content-center text-white rounded-start-4 px-4" style="background: linear-gradient(135deg, #0d6efd, #6f42c1);">
                                <i class="bi bi-journal-bookmark fs-1"></i>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-center p-4">
                                <h5 class="fw-bold">{{ $page['title'] }}</h5>
                                <p class="text-muted">Lihat daftar data yang pernah dihapus.</p>
                                <a href="{{ $page['page'] }}" class="btn btn-outline-primary rounded-pill mt-2">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</x-app-layout>
