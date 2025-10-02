<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="">
        <h2>{{ $book['bk_title'] }}</h2>
        <embed src="{{ asset($book['bk_file_url']) }}" type="application/pdf" width="100%"
            height="700px" />
    </div>
</x-app-layout>
