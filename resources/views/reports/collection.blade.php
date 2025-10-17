<x-app-layout>
    <x-slot:title>Export Data Koleksi</x-slot:title>

    <div class="mt-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-0">Export Koleksi Buku</h5>
                <form action="/system/export/collection" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" id="start_date"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date"
                                class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="all_data"
                                id="all_data" value="1" checked>
                            <label class="form-check-label fw-bold text-warning">Export seluruh data
                                (abaikan tanggal)</label>
                        </div>
                    </div>

                    <hr>
                    <h6 class="fw-bold">Pilih Kolom Data</h6>
                    <div class="row">
                        @php
                            $columns = [
                                'bk_id' => 'ID',
                                'bk_created_at' => 'Tanggal Dibuat',
                                'author' => 'Pengarang',
                                'bk_title' => 'Judul',
                                'bk_edition_volume' => 'Jilid / Edisi',
                                'book_copies' => 'Jumlah Salinan',
                                'publisher' => 'Tempat Terbit',
                                'bk_publisher' => 'Penerbit',
                                'bk_published_year' => 'Tahun Terbit',
                                'origin' => 'Sumber',
                                'bk_price' => 'Harga Satuan',
                                'total_price' => 'Harga Keseluruhan',
                                'ddc' => 'Nomor Klasifikasi',
                            ];
                        @endphp
                        @foreach ($columns as $key => $label)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="columns[]"
                                        value="{{ $key }}" checked>
                                    <label class="form-check-label">{{ $label }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-file-earmark-excel"></i> Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
