<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form class="container mt-4">
    <div class="row g-4 align-items-start">

   
      <div class="col-12 col-md-4 d-flex flex-column align-items-center">
        <img src="..." class="rounded-circle shadow object-fit-cover mb-2" 
             alt="Profile Image" width="200" height="200">
             <input type="file" id="profileImage" class="d-none">
             <a href="#" class="text-decoration-none" onclick="document.getElementById('profileImage').click();">Ubah Foto Profil</a>
      </div>

      
      <div class="col-12 col-md-8">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" id="nama" class="form-control" autocomplete="off">
        </div>

        <div class="mb-3">
          <label for="whatsapp" class="form-label">No WhatsApp</label>
          <input type="text" id="whatsapp" class="form-control">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" autocomplete="off">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Konfirmasi Password</label>
          <input type="password" id="password" class="form-control" autocomplete="off">
        </div>
    <div class="options">
  <p class="text-3 mb-1">Pilih peran</p>

  <select class="form-select" aria-label="Default select example">
    <option selected>pilih peran kamu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
</div>

<!-- From Uiverse.io by adamgiebl -->
<div class="d-flex justify-content-center mt-5">
  <button type="button" class="btn btn-outline-info w-100" style="height: 50px; border-radius: 20px;">Selesai</button>
</div>


    </div>
  </form>


 </x-app-layout>
