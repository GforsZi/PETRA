<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
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

</x-app-layout>
