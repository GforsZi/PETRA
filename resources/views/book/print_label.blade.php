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
            background: white;
        }

        .page {
            display: grid;
            grid-template-columns: repeat(2, 8cm);
            grid-auto-rows: 4cm;
            gap: 20px 30px;
            justify-content: center;
            page-break-inside: avoid;
        }

        /* Label utama */
        .label-cell {
            position: relative;
            width: 77mm;
            height: 41mm;
            border: 2px solid black;
            padding: 0;
            page-break-inside: avoid;
            break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            color: black;
            overflow: hidden;
        }

        /* Lapisan warna kuning disini ngubah bagroundnya pal  */
        .label-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #fff200; 
            z-index: 0;
        }

        /* Isi label */
        .label-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: table;
            border-collapse: collapse;
            page-break-inside: avoid;
            background: transparent;
        }

        .label-header {
            display: grid;
            grid-template-columns: 2cm auto;
            height: 1.5cm;
            border-bottom: 2px solid black;
            background: transparent;
        }

        .label-logo-cell {
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
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
            background: transparent;
        }

        .label-header-text h5 {
            margin: 0;
            font-weight: bold;
            font-size: 15px;
            color: black;
        }

        .label-body {
            height: 2.5cm;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: transparent;
        }

        .label-body-content h4,
        .label-body-content h5 {
            font-weight: bold;
            margin: 4px 0;
            font-size: 13px;
            color: black;
        }

        .label-body-content p {
            margin: 2px 0;
            font-size: 13px;
            color: black;
        }
    </style>

</head>

<body>
    @php $col = 0; @endphp
    <div class="page">
        @foreach ($books['bookCopies'] as $book)
            <div class="label-cell">
                <!-- Lapisan kuning -->
                <div class="label-bg"></div>

                <!-- Isi label -->
                <div class="label-wrapper">
                    <div class="label-header">
                        <div class="label-logo-cell">
                            <img src="{{ public_path('logo/landing/smk.png') }}" alt="Logo" class="label-logo">
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
                            <p>{{ Str::substr(strtolower($books['bk_title']), 0, 1) ?? '' }}</p>
                            <p><strong>{{ $book->bk_cp_number ?? '' }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
            @php $col++; @endphp
        @endforeach
    </div>
</body>

</html>
