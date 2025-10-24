<x-app-layout>
    <x-slot:title>Export Data Anggota</x-slot:title>

    <div class="mt-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Kustomisasi Export Excel</h5>
                <form action="/system/export/membership" method="POST">
                    @csrf

                    {{-- Rentang Tanggal --}}
                    {{-- Rentang Tanggal --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Awal</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                    </div>

                    {{-- Checkbox Cetak Semua Data --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="print_all" id="print_all">
                        <label class="form-check-label fw-bold text-warning" for="print_all">
                            Cetak Semua Data (abaikan tanggal)
                        </label>
                    </div>

                    {{-- Role (Multiple Select) --}}
                    <div class="mb-3">
                        <label class="form-label">Pilih Role</label>
                        <select name="roles[]" class="form-select" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->rl_name }}">{{ $role->rl_name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Tekan <kbd>Ctrl</kbd> / <kbd>Cmd</kbd> untuk memilih
                            lebih dari satu.</div>
                    </div>

                    {{-- Kolom --}}
                    <div class="mb-3">
                        <label class="form-label">Pilih Kolom Data</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="columns[]" value="usr_id" checked>
                            <label class="form-check-label">ID</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="columns[]" value="name" checked>
                            <label class="form-check-label">Nama Lengkap</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="columns[]" value="usr_no_wa" checked>
                            <label class="form-check-label">No Whatsapp</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="columns[]" value="roles" checked>
                            <label class="form-check-label">Peran</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="columns[]" value="usr_created_at" checked>
                            <label class="form-check-label">Tanggal Dibuat</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
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
