<x-app-layout>
    <x-slot:title>Export Data Transaksi</x-slot:title>

    <div class="mt-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Kustomisasi Export Excel</h5>

                <form action="/system/export/transaction" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Tanggal Awal</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="print_all" id="print_all">
                        <label class="form-check-label fw-bold text-warning" for="print_all">Cetak
                            Semua
                            Data (abaikan
                            tanggal)</label>
                    </div>

                    <div class="mb-3">
                        <label>Pilih Kolom</label>
                        @php
                            $available = [
                                'trx_id' => 'ID Transaksi',
                                'user_name' => 'Nama Peminjam',
                                'books' => 'Judul Buku',
                                'book_copies' => 'Nomor Salinan',
                                'trx_borrow_date' => 'Tanggal Pinjam',
                                'trx_due_date' => 'Tanggal Jatuh Tempo',
                                'trx_return_date' => 'Tanggal Pengembalian',
                                'trx_status' => 'Status',
                                'trx_description' => 'Deskripsi',
                                'trx_sys_note' => 'Catatan Sistem',
                            ];
                        @endphp

                        @foreach ($available as $key => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="columns[]" value="{{ $key }}" id="col_{{ $key }}" checked>
                                <label class="form-check-label" for="col_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success" type="submit"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
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
