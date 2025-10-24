<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $columns;
    protected $statusFilter;

    protected $columnLabels = [
        'trx_id' => 'ID Transaksi',
        'user_name' => 'Nama Peminjam',
        'books' => 'Judul Buku',
        'book_copies' => 'Nomor Salinan',
        'trx_borrow_date' => 'Tanggal Pinjam',
        'trx_due_date' => 'Tanggal Jatuh Tempo',
        'trx_return_date' => 'Tanggal Pengembalian',
        'trx_status' => 'Status',
        'trx_description' => 'Deskripsi',
        'trx_sys_note' => 'Catatan Sistem',
    ];

    public function __construct($startDate = null, $endDate = null, $columns = [], $statusFilter = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->columns = $columns ?: array_keys($this->columnLabels);
        $this->statusFilter = $statusFilter;
    }

    public function collection()
    {
        $query = Transaction::with(['user', 'bookTransactions.book', 'bookTransactions.bookCopy'])->orderBy('trx_borrow_date', 'desc');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('trx_borrow_date', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);
        }

        if (is_array($this->statusFilter) && count($this->statusFilter) > 0) {
            $query->whereIn('trx_status', $this->statusFilter);
        }

        return $query->get();
    }

    public function headings(): array
    {
        // Gunakan urutan kolom sesuai request
        return array_map(fn($c) => $this->columnLabels[$c] ?? ucfirst($c), $this->columns);
    }

    public function map($trx): array
    {
        // Prepare books and copies as strings
        // Format: "Title1 (CopyNo1); Title2 (CopyNo2)"
        $items = $trx->bookTransactions->map(function ($bt) {
            $title = $bt->book->bk_title ?? '-';
            $copy = $bt->bookCopy->bk_cp_number ?? '-';
            return "{$title} ({$copy})";
        });

        $booksString = $items->pluck(0)->implode(', '); // not used, kept for compatibility
        // Instead we'd build two columns if requested.

        return collect($this->columns)
            ->map(function ($col) use ($trx, $items) {
                return match ($col) {
                    'user_name' => $trx->user->name ?? '-',
                    'books' => $trx->bookTransactions->map(fn($bt) => $bt->book->bk_title ?? '-')->unique()->implode(', '),
                    'book_copies' => $trx->bookTransactions->map(fn($bt) => $bt->bookCopy->bk_cp_number ?? 'Seluruh salinan')->implode(', '),
                    'trx_borrow_date' => optional($trx->trx_borrow_date)->format('d/m/Y H:i'),
                    'trx_due_date' => optional($trx->trx_due_date)->format('d/m/Y H:i'),
                    'trx_return_date' => optional($trx->trx_return_date)->format('d/m/Y H:i'),
                    'trx_status' => $this->statusLabel($trx->trx_status),
                    'trx_description' => $trx->trx_description ?? '-',
                    'trx_sys_note' => $trx->trx_sys_note ?? '-',
                    default => $trx->{$col} ?? '-',
                };
            })
            ->toArray();
    }

    private function statusLabel($code)
    {
        return match ($code) {
            '1' => 'Pengajuan',
            '2' => 'Dipinjam',
            '3' => 'Dikembalikan',
            '4' => 'Ditolak',
            default => $code,
        };
    }

    public function styles(Worksheet $sheet)
    {
        // Hitung kolom terakhir secara otomatis
        $lastColumn = $sheet->getHighestColumn();

        // Style header
        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'E9AD01'],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '121740'], // Warna biru gelap
            ],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Border seluruh area data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
