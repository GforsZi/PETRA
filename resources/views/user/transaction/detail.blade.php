<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid p-4">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-dark h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://covers.openlibrary.org/b/id/7884866-L.jpg"
                                 alt="Sampul Buku Harry Potter"
                                 class="rounded shadow-sm"
                                 style="width: 150px; height: 200px; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold">Harry Potter and the Philosopher's Stone</h5>
                        <p class="mb-1"><strong>Penulis:</strong> J.K. Rowling</p>
                        <p class="mb-1"><strong>Penerbit:</strong> Bloomsbury</p>
                        <p class="mb-1"><strong>Tanggal Terbit:</strong> 26 Juni 1997</p>
                        <p class="mb-1"><strong>Halaman:</strong> 223</p>
                        <p class="mb-1"><strong>Kategori:</strong> Fantasi</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card text-dark h-100">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Deskripsi</h5>
                        <p>
                            Buku pertama dari seri fenomenal Harry Potter, menceritakan
                            kisah seorang anak yatim piatu yang mengetahui dirinya adalah
                            seorang penyihir dan memasuki sekolah sihir Hogwarts.
                            Petualangan, persahabatan, dan pertarungan melawan kekuatan
                            gelap dimulai di sini.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
