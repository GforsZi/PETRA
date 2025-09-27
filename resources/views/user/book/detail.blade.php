<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
 <div class="container mt-4">
  <div class="row g-3">
    
    <!-- Card Buku -->
    <div class="col-12 col-lg-6">
      <div class="card h-100">
        <div class="row g-0">
       
          <div class="col-md-5 d-flex align-items-center">
            <img src="{{ asset('logo/landing/Aesop.png') }}" 
                 class="img-fluid rounded-start" alt="Buku">
          </div>
          
          <div class="col-md-7">
            <div class="card-body">
              <h3 class="card-title fw-bold">Aesop</h3>
              <br>
              <div class="mb-2"><strong>Penulis:</strong> <span class="ms-2"> </span></div>  <!-- isian data disini -->
              <div class="mb-2"><strong>Penerbit:</strong> <span class="ms-2"> </span></div>
              <div class="mb-2"><strong>Tanggal terbit:</strong> <span class="ms-2"> </span></div>
              <div class="mb-2"><strong>Halaman:</strong> <span class="ms-2"> </span></div>
              <div class="mb-2"><strong>Kategori:</strong> <span class="ms-2"> </span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6 ">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title fw-bold">Deskripsi</h5>
          <br>
          <p class="card-text"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta animi doloribus aliquid suscipit nemo corporis voluptas, sed corrupti nesciunt exercitationem culpa dolore modi nobis nam cupiditate a blanditiis cum numquam accusantium doloremque quae et. Omnis repellat maiores enim accusantium consectetur distinctio, repellendus sapiente doloremque rerum libero dolorum ratione eos obcaecati ipsa cum aliquid, quidem, quae excepturi. Dolorem officia quaerat non explicabo, beatae earum sint sed assumenda amet odio cupiditate facere rem incidunt ex! Sequi vitae perferendis qui, assumenda aspernatur beatae voluptatem fugiat dolores repellat autem molestiae quos cumque eligendi ex nihil distinctio voluptas amet fugit unde perspiciatis neque nam doloremque? </p> <!-- isian descripsi  -->
        </div>
      </div>
    </div>

  </div>
</div>
</x-app-layout>
