<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ session('success') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>{{ session('error') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($histories)
        <x-table_data :paginator="$histories">
            <x-slot:title></x-slot:title>
            <x-slot:header>
                <th style="width: 10px">No</th>
                <th>nama</th>
                <th>No WhatsApp</th>
                <th>Dihapus pada</th>
                <th style="width: 50px"></th>
            </x-slot:header>
            @forelse ($histories as $index => $history)
                <tr class="align-middle">
                    <td>{{ $histories->firstItem() + $index }}</td>
                    <td>{{ $history->name }}</td>
                    <td>{{ $history->usr_no_wa }}</td>
                    <td>{{ $history->usr_deleted_at }}</td>
                    <td>
                        <div class="dropdown dropstart">
                            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-menu-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ $page_url . '/' . $history->usr_id . '/detail' }}">Detail</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#restore{{ $histories->firstItem() + $index }}">Pulihkan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="modal fade" id="restore{{ $histories->firstItem() + $index }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="restore{{ $histories->firstItem() + $index }}Label" aria-hidden="true">
                            <form action="/system/restore/{{ $history->usr_id }}" method="post" class="modal-dialog modal-dialog-centered">
                                @csrf
                                @method('PUT')
                                <div class="modal-content rounded-3 shadow">
                                    <div class="modal-body p-4 text-center">
                                        <h5 class="mb-0">Hapus data ini?</h5>
                                        <p class="mb-0">Apakah anda yakin untuk memulihkan data ini?</p>
                                    </div>
                                    <input type="hidden" value="Account" name="model">
                                    <div class="modal-footer flex-nowrap p-0">
                                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button>
                                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"
                                            onclick="this.disabled=true; this.form.submit();"><strong>Pulihkan</strong></button>
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
    @endif
</x-app-layout>
