<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
      @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
         <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        @endif
   <div class="profil">
  <div class="card shadow-sm mb-3 w-100">
    <div class="row g-0 align-items-center">

      <div class="col-12 col-md-4 d-flex justify-content-center p-3">
        <img src="..." class="rounded-circle shadow object-fit-cover" alt="Profile Image" width="200" height="200">
      </div>

      <div class="col-12 col-md-8">
        <div class="card-body text-center text-md-start">
          <h5 class="card-title mb-3"></h5>

          <div class="d-flex justify-content-start mb-2">
            <strong>Nama:</strong>
            <span></span>
          </div>

          <div class="d-flex justify-content-start mb-2">
            <strong>No. Telp:</strong>
            <span></span>
          </div>

          <div class="d-flex justify-content-start mb-2">
            <strong>Role:</strong>
            <span></span>
          </div>

          <div class="d-flex justify-content-start mb-2">
            <strong>Status:</strong>
            <span></span>
          </div>

          <div class="mt-3 d-flex gap-2">
            <button class="button flex-center" title="Pengaturan">
              <i class='bxr bx-cog' style='color:#f4ff0a; font-size: 25px;'></i>
            </button>
            <button class="button flex-center" title="Ubah profil">
              <i class='bxr bx-edit' style='color:#f4ff0a; font-size: 25px;'></i>
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

                <!-- From Uiverse.io by Pradeepsaranbishnoi --> 
                <!-- From Uiverse.io by MarcLazz --> 


<style>
  /* From Uiverse.io by MarcLazz */ 
.button-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1.5rem;
}

.button {
  cursor: pointer;
  text-decoration: none;
  color: #ffff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #2d2e32;
  border: 2px solid #2d2e32;
  transition: all 0.45s;
}

.button:hover {
  transform: rotate(360deg);
  transform-origin: center center;
  background-color: gray;
  color: #2d2e32;
}

.button:hover .btn-svg {
  filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(305deg)
    brightness(103%) contrast(103%);
}

.flex-center {
  display: flex;
  justify-content: center;
  align-items: center;
}

</style>

</x-app-layout>