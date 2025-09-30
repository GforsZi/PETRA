<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form>
        <div class="row g-4 align-items-start">
            <!-- Kolom Daftar Buku Dipilih -->
            <div class="col-md-4">
                <h5 class="mb-3">Buku yang Dipinjam</h5>
                <div id="listBukuDipilih" 
                     class="border rounded p-2 bg-light" 
                     style="max-height: 300px; overflow-y: auto;">
                    <p class="text-muted m-0" id="noBukuText">Belum ada buku dipilih</p>
                </div>
                <!-- Button trigger modal -->
                <button type="button" 
                        class="btn btn-primary mt-3 w-100" 
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal">
                    Pilih Buku
                </button>
            </div>

            <!-- Kolom Form -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Tujuan Peminjaman</label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control"></textarea>
                </div>

                <div class="mb-3">
                <label class="form-label">Tanggal Peminjaman</label>
                <input type="datetime-local" class="form-control">
                </div>


                <button type="submit" class="btn btn-outline-success w-100">Kirim</button>
            </div>
        </div>
    </form>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Buku</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- search -->
          <div class="input-group mb-3 shadow-sm border border-dark rounded">
            <input type="text" class="form-control border-0" placeholder="Cari sesuatu..." aria-label="Search">
            <button
              class="btn btn-primary border-0 px-4 d-flex align-items-center justify-content-center"
              type="button">
              <i class="bi bi-search fs-5"></i>
            </button>
          </div>

          <!-- kolom buku dengan scroll -->
          <div class="container-fluid text-center" style="max-height: 200px; overflow-y: auto;">
            <div class="row row-cols-2 row-cols-md-4 g-3">
              <div class="col">
                <img src="{{ asset('logo/book_placeholder.jpg') }}" 
                     class="img-fluid border rounded shadow-sm pilih-buku"
                     data-nama="Buku 1"
                     style="max-width: 120px; height: auto; cursor: pointer;">
              </div>
              <div class="col">
                <img src="{{ asset('logo/book_placeholder.jpg') }}" 
                     class="img-fluid border rounded shadow-sm pilih-buku"
                     data-nama="Buku 2"
                     style="max-width: 120px; height: auto; cursor: pointer;">
              </div>
              <div class="col">
                <img src="{{ asset('logo/book_placeholder.jpg') }}" 
                     class="img-fluid border rounded shadow-sm pilih-buku"
                     data-nama="Buku 3"
                     style="max-width: 120px; height: auto; cursor: pointer;">
              </div>
              <div class="col">
                <img src="{{ asset('logo/book_placeholder.jpg') }}" 
                     class="img-fluid border rounded shadow-sm pilih-buku"
                     data-nama="Buku 4"
                     style="max-width: 120px; height: auto; cursor: pointer;">
              </div>
              <div class="col">
                <img src="{{ asset('logo/book_placeholder.jpg') }}" 
                     class="img-fluid border rounded shadow-sm pilih-buku"
                     data-nama="Buku 5"
                     style="max-width: 120px; height: auto; cursor: pointer;">
              </div>
              <div class="col">
                <img src="{{ asset('logo/book_placeholder.jpg') }}" 
                     class="img-fluid border rounded shadow-sm pilih-buku"
                     data-nama="Buku 6"
                     style="max-width: 120px; height: auto; cursor: pointer;">
              </div>
            </div>
          </div>
          <!-- akhir -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Script -->
    <script>
      document.querySelectorAll('.pilih-buku').forEach(img => {
        img.addEventListener('click', function() {
          const listContainer = document.getElementById('listBukuDipilih');
          const noText = document.getElementById('noBukuText');

          // hilangkan teks default
          if(noText) noText.remove();

          // buat card kecil buku yang dipilih
          const card = document.createElement('div');
          card.className = "card mb-2 shadow-sm";
          card.style.maxWidth = "100%";

         card.innerHTML = `
  <div class="row g-0 align-items-stretch">
    <div class="col-4">
      <img src="${this.src}" class="img-fluid rounded-start h-100" alt="buku" style="object-fit:cover;">
    </div>
    <div class="col-8 d-flex flex-column justify-content-between">
      <div class="p-2">
        <h6 class="card-title fw-bold mb-0">${this.dataset.nama}</h6>
      </div>
      <div class="p-2 d-flex justify-content-end">
        <button type="button" class="btn btn-sm btn-danger hapus-buku">Hapus</button>
      </div>
    </div>
  </div>
`;

          // tambahkan ke list
          listContainer.appendChild(card);

          // event hapus
          card.querySelector('.hapus-buku').addEventListener('click', () => {
            card.remove();
            if(listContainer.children.length === 0) {
              listContainer.innerHTML = '<p class="text-muted m-0" id="noBukuText">Belum ada buku dipilih</p>';
            }
          });

          // tutup modal
          const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
          modal.hide();
        });
      });
    </script>
</x-app-layout>
