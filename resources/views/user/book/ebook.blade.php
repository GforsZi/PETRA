<x-app-layout>
    <x-slot:title>{{ $book->bk_title }}</x-slot:title>

    <style>
        body {
            background-color: #111;
            color: #fff;
        }

        .reader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            margin: 2rem auto;
            max-width: 900px;
        }

        .page-img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
            transition: transform 0.2s ease-in-out;
        }

        .page-img:hover {
            transform: scale(1.02);
        }

        .back-btn {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: #fff;
            color: #111;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
        }

        .back-btn:hover {
            background: #ccc;
        }
    </style>

    <div class="reader-container">
        @foreach ($images as $img)
            <img src="{{ $img }}" alt="Halaman" class="page-img" loading="lazy">
        @endforeach
    </div>
</x-app-layout>
