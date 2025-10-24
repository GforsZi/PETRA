<?php

namespace App\Exports;

use App\Models\Book;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CollectionExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnFormatting {
    protected $startDate, $endDate, $allData, $columns;

    public function __construct($startDate = null, $endDate = null, $allData = false, $columns = []) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->allData = $allData;
        $this->columns = $columns;
    }

    /**
     * Ambil data buku
     */
    public function collection() {
        $query = Book::with([
            'authors:athr_id,athr_name',
            'publisher:pub_id,pub_name,pub_address',
            'deweyDecimalClassfications:ddc_id,ddc_code',
            'origin:bk_orgn_id,bk_orgn_name',
            'bookCopies:bk_cp_id,bk_cp_book_id'
        ]);

        if (!$this->allData && $this->startDate && $this->endDate) {
            $query->whereBetween('bk_created_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);
        }

        return $query->get();
    }

    /**
     * Header kolom dinamis
     */
    public function headings(): array {
        $map = [
            'bk_id' => 'ID',
            'bk_created_at' => 'Tanggal Dibuat',
            'author' => 'Pengarang',
            'bk_title' => 'Judul',
            'bk_edition_volume' => 'Jilid / Edisi',
            'book_copies' => 'Jumlah Salinan',
            'bk_publisher' => 'Penerbit',
            'bk_published_year' => 'Tahun Terbit',
            'publisher' => 'Tempat Terbit',
            'origin' => 'Sumber',
            'bk_price' => 'Harga Satuan',
            'total_price' => 'Harga Keseluruhan',
            'ddc' => 'Nomor Klasifikasi'
        ];

        return array_map(fn($key) => $map[$key] ?? $key, $this->columns);
    }

    /**
     * Style
     */
    public function styles(Worksheet $sheet) {
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'E9AD01'],
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center'
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '121740']
            ]
        ]);

        $sheet->getRowDimension(1)->setRowHeight(25);

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000']
                ]
            ]
        ]);
    }

    /**
     * Mapping per baris dinamis
     */
    public function map($book): array {
        $amount_copies = $book->bookCopies->count() ?? 0;
        $unit_price = $book->bk_unit_price ?? 0;
        $total_price = $amount_copies * $unit_price;

        $data = [
            'bk_id' => $book->bk_id,
            'bk_created_at' => optional($book->bk_created_at)->format('d/m/Y H:i') ?? '-',
            'author' => $book->authors->pluck('athr_name')->implode(', ') ?: '-',
            'bk_title' => $book->bk_title ?? '-',
            'bk_edition_volume' => $book->bk_edition_volume ?? '-',
            'book_copies' => $amount_copies,
            'publisher' => $book->publisher->pub_address ?? '-',
            'bk_publisher' => $book->publisher->pub_name ?? '-',
            'bk_published_year' => $book->bk_published_year ?? '-',
            'origin' => $book->origin->bk_orgn_name ?? '-',
            'bk_price' => 'Rp' . number_format($unit_price ?? 0, 0, ',', '.'),
            'total_price' => 'Rp' . number_format($total_price ?? 0, 0, ',', '.'),
            'ddc' => $book->deweyDecimalClassfications->pluck('ddc_code')->map(fn($c) => trim($c))->filter()->unique()->implode('.') ?: '-'
        ];

        // Hanya tampilkan kolom yang dipilih user
        return array_intersect_key($data, array_flip($this->columns));
    }

    public function columnFormats(): array {
        return [
            'M' => NumberFormat::FORMAT_TEXT // kolom E misalnya berisi DDC
        ];
    }
}
