<x-app-layout>
    <x-slot:title>Export Data Koleksi</x-slot:title>

    <div class="mt-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-0">Kustomisasi Export Excel</h5>
                <form action="/system/export/collection" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="all_data" id="print_all" value="1">
                            <label class="form-check-label fw-bold text-warning">Cetak Semua
                                Data (abaikan tanggal)</label>
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
                                    <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $key }}" checked>
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
    <script>
        const printAll = document.getElementById('print_all');
        const start = document.querySelector('input[name="start_date"]');
        const end = document.querySelector('input[name="end_date"]');

        printAll?.addEventListener('change', function() {
            const disabled = this.checked;
            start.disabled = disabled;
            end.disabled = disabled;
            if (disabled) {
                start.value = '';
                end.value = '';
            }
        });
    </script>
</x-app-layout>
