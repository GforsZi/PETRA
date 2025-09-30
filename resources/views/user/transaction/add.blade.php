<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container d-flex justify-content-left align-items-center" style="height: 60vh;">
        <div class="w-100" style="max-width: 400px;">
            <button class="btn btn-success mb-3">Tambah buku</button>
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-black rounded-2  clearable"
                    placeholder="Nama buku">
                <button class="btn btn-danger d-none clear-btn" type="button">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-black rounded-2  clearable"
                    placeholder="Nama peminjam">
                <button class="btn btn-danger d-none clear-btn" type="button">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control border border-black rounded-2 clearable"
                    placeholder="Tanggal pinjam">
                <button class="btn btn-danger d-none clear-btn" type="button">
                    <i class="bi bi-x"></i>
                </button>

            </div>
            <button class="btn btn-primary">Kirim</button>
        </div>
    </div>

    <script>
        document.querySelectorAll('.clearable').forEach((input, index) => {
            const clearBtn = input.parentElement.querySelector('.clear-btn');

            input.addEventListener('input', () => {
                if (input.value.length > 0) {
                    clearBtn.classList.remove('d-none');
                } else {
                    clearBtn.classList.add('d-none');
                }
            });

            clearBtn.addEventListener('click', () => {
                input.value = '';
                clearBtn.classList.add('d-none');
                input.focus();
            });
        });
    </script>

</x-app-layout>
