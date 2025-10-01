<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form class="container mt-4" action="/system/admin/profile/edit" method="post">
        @csrf
        <div class="row g-4 align-items-start">

            <div class="col-12 col-md-4 d-flex flex-column align-items-center">
                <img src="{{ asset($user['usr_img_url'] ?? 'logo/user_placeholder.jpg') }}"
                    class="rounded-circle shadow object-fit-cover mb-2" alt="Profile Image"
                    width="200" height="200">
                <input type="file" id="profileImage" class="d-none">
                <a href="#" class="text-decoration-none"
                    onclick="document.getElementById('profileImage').click();">Ubah Foto Profil</a>
            </div>

            <div class="col-12 col-md-8">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input value="{{ $user['name'] }}" name="name" type="text" id="nama"
                        class="form-control @error('name') is-invalid @enderror" autocomplete="off">
                        @error('Name')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Input tidak sesuai</p>
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">No WhatsApp</label>
                    <input value="{{ $user['usr_no_wa'] }}" name="usr_no_wa" type="text"
                        id="whatsapp"
                        class="form-control @error('usr_no_wa') is-invalid @enderror">
                        @error('usr_no_Wa')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Input tidak sesuai</p>
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">Bio</label>
                    <textarea name="usr_bio" class="form-control @error('usr_bio') is-invalid @enderror"
                        id="autoExpand">{{ $user['usr_bio'] }}</textarea>
                        @error('usr_bio')
                        <div class="invalid-feedback">
                            <p style="text-align: right;">Input tidak sesuai</p>
                        </div>
                    @enderror
                </div>

                <!-- From Uiverse.io by adamgiebl -->
                <div class="d-flex justify-content-start">
                    <button type="submit"
                        class=" btn btn-outline-warning px-5 d-flex justify-content-center align-items-center"
                        id="tombol"> Submit</button>

                </div>
            </div>

        </div>
    </form>
</x-app-layout>
