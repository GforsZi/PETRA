<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Label</title>
    <style>
        @page {
            size: A4;
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .page {
            display: grid;
            grid-template-columns: repeat(2, 8cm);
            /* 2 kolom */
            grid-auto-rows: 4cm;
            /* tinggi baris */
            gap: 20px 30px;
            /* jarak antar label */
            justify-content: center;
            /* posisi ke tengah halaman */
        }

        .label-cell {
            margin-bottom: 50px;
            width: 8cm;
            height: 4cm;
            border: 2px solid black;
            background: #fff;
            padding: 0;
        }

        .label-wrapper {
            width: 100%;
            height: 100%;
            display: table;
            border-collapse: collapse;
        }

        /* Header pakai grid agar garis pemisah nyambung */
        .label-header {
            display: grid;
            grid-template-columns: 2cm auto;
            /* kolom logo | kolom teks */
            height: 1.5cm;
            border-bottom: 2px solid black;
        }

        .label-logo-cell {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .label-logo {
            width: 1.2cm;
            height: 1.2cm;
        }

        .label-header-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            border-left: 2px solid black;
            /* garis pemisah rapi */
        }

        .label-header-text h5 {
            margin: 0;
            font-weight: bold;
            font-size: 15px;
        }

        /* Body */
        .label-body {
            height: 2.5cm;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .label-body-content h4,
        .label-body-content h5 {
            font-weight: bold;
            margin: 4px 0;
            font-size: 13px;
        }

        .label-body-content p {
            margin: 2px 0;
            font-size: 13px;
        }
    </style>

</head>

<body>

    @php $col = 0; @endphp
    <div class="page">
        @foreach ($books['bookCopies'] as $book)
            <!-- Label 1 -->
            <div class="label-cell">
                <div class="label-header">
                    <div class="label-logo-cell">
                        <img src="{{ public_path('logo/landing/smk.png') }}" alt="Logo"
                            class="label-logo">
                    </div>
                    <div class="label-header-text">
                        <h5>PERPUSTAKAAN</h5>
                        <h5>SMK MAHAPUTRA</h5>
                    </div>
                </div>
                <div class="label-body">
                    <div class="label-body-content">
                        <h4>
                            @foreach ($books['deweyDecimalClassfications'] as $ddc)
                                {{ $ddc->ddc_code }}@if (!$loop->last)
                                    .
                                @endif
                            @endforeach
                        </h4>
                        <h5>
                            @foreach ($books['authors'] as $author)
                                {{ Str::substr(strtoupper($author->athr_name), 0, 3) }}
                                @if (!$loop->last)
                                    .
                                @endif
                            @endforeach
                        </h5>
                        <p>{{ Str::substr(strtolower($book['bk_title']), 0, 1) ?? '' }}</p>
                        <p><strong>{{ $book->bk_cp_number ?? '' }}</strong></p>
                    </div>
                </div>
            </div>
            @php $col++; @endphp

            {{-- Buat 2 kolom per baris --}}
            @if ($col % 2 == 0)
            @endif
        @endforeach
    </div>
</body>

</html>
