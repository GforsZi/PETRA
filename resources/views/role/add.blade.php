<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Nama Peran Baru</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Contoh: Atmin">
    </div>
    <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Keterangan Peran Baru</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  placeholder="Role ini untuk mengelola sistem"></textarea>
    </div>
    <div class="d-flex justify-content-end mt-5">
    <button type="submit" class=" w-25 d-flex justify-content-center align-items-center" id="tombol">
        Selesai
    </button>
    </div>
    <style>
    #tombol {
    --green: #1BFD9C;
    font-size: 15px;
    padding: 0.7em 2.7em;
    letter-spacing: 0.06em;
    position: relative;
    font-family: inherit;
    border-radius: 0.6em;
    overflow: hidden;
    transition: all 0.3s;
    line-height: 1.4em;
    border: 2px solid var(--green);
    background: linear-gradient(to right, rgba(27, 253, 156, 0.1) 1%, transparent 40%,transparent 60% , rgba(27, 253, 156, 0.1) 100%);
    color: var(--green);
    box-shadow: inset 0 0 10px rgba(27, 253, 156, 0.4), 0 0 9px 3px rgba(27, 253, 156, 0.1);
    }

    #tombol:hover {
    color: #82ffc9;
    box-shadow: inset 0 0 10px rgba(27, 253, 156, 0.6), 0 0 9px 3px rgba(27, 253, 156, 0.2);
    }

    #tombol:before {
    content: "";
    position: absolute;
    left: -4em;
    width: 4em;
    height: 100%;
    top: 0;
    transition: transform .4s ease-in-out;
    background: linear-gradient(to right, transparent 1%, rgba(27, 253, 156, 0.1) 40%,rgba(27, 253, 156, 0.1) 60% , transparent 100%);
    }

    #tombol:hover:before {
    transform: translateX(30em);
    }

    </style>
</x-app-layout>
