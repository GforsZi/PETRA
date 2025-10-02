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
            width: 100%;
            border-collapse: collapse;
        }

        .label-cell {
            width: 8cm;
            height: 4cm;
            border: 2px solid black;
            padding: 0;
            vertical-align: top;
        }

        .label-wrapper {
            width: 8cm;
            height: 4cm;
            box-sizing: border-box;
            display: table;
        }

        /* Header */
        .label-header {
            display: table-row;
            height: 1.5cm;
            border-bottom: 2px solid black;
        }

        .label-logo-cell {
            display: table-cell;
            width: 2cm;
            text-align: center;
            vertical-align: middle;
            border-right: 2px solid black;
        }

        .label-logo {
            width: 1.2cm;
            height: 1.2cm;
            border-radius: 50%;
        }

        .label-header-text {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            font-size: 11px;
        }

        .label-header-text h5 {
            margin: 0;
            font-weight: bold;
            font-size: 12px;
        }

        /* Body */
        .label-body {
            display: table-row;
        }

        .label-body-content {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            padding: 4px;
        }

        .label-body-content h4,
        .label-body-content h5 {
            font-weight: bold;
            margin: 2px 0;
        }

        .label-body-content p {
            margin: 1px 0;
        }
    </style>
</head>

<body>
    <table class="page">
        @php $col = 0; @endphp
        <tr>
            @foreach ($books['bookCopies'] as $book)
                <td class="label-cell">
                    <div class="label-wrapper">
                        <!-- Header -->
                        <div class="label-header">
                            <div class="label-logo-cell">
                                <img src="{{ public_path('logo/landing/smk.png') }}" alt="Logo Petra"
                                    class="label-logo">
                            </div>
                            <div class="label-header-text">
                                <h5>PERPUSTAKAAN</h5>
                                <h5>SMK MAHAPUTRA</h5>
                            </div>
                        </div>

                        <!-- Body -->
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
                </td>

                @php $col++; @endphp

                {{-- Buat 2 kolom per baris --}}
                @if ($col % 2 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>
