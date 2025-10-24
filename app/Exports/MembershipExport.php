<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembershipExport implements FromCollection, WithStyles, WithHeadings, WithMapping, ShouldAutoSize {
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $startDate, $endDate, $roles, $columns;

    public function __construct($startDate, $endDate, $roles, $columns) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->roles = $roles;
        $this->columns = $columns ?? ['usr_id'];
    }

    protected $columnLabels = [
        'usr_id' => 'ID',
        'name' => 'Nama Lengkap',
        'usr_no_wa' => 'Nomor Whatsapp',
        'roles' => 'Peran',
        'usr_created_at' => 'Tanggal Dibuat'
    ];

    public function collection() {
        $query = User::with('roles');

        // Jika tanggal tidak kosong, filter berdasarkan tanggal
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('usr_created_at', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()]);
        }

        // Filter berdasarkan role (jika ada)
        if ($this->roles) {
            $query->whereHas('roles', fn($q) => $q->whereIn('rl_name', $this->roles));
        }

        return $query->get();
    }

    public function headings(): array {
        return array_map(fn($col) => $this->columnLabels[$col] ?? ucfirst($col), $this->columns);
    }

    public function styles(Worksheet $sheet) {
        // Hitung kolom terakhir secara otomatis
        $lastColumn = $sheet->getHighestColumn();

        // Style header
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
                'startColor' => ['rgb' => '121740'] // Warna biru gelap
            ]
        ]);
        $sheet->getRowDimension(1)->setRowHeight(25);

        // Border seluruh area data
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

    public function map($user): array {
        return collect($this->columns)
            ->map(function ($col) use ($user) {
                return match ($col) {
                    'roles' => $user->roles->rl_name ?? '-',
                    'usr_created_at' => $user->usr_created_at->format('d/m/Y H:i') ?? '-',
                    'usr_updated_at' => optional($user->usr_updated_at)->format('d/m/Y H:i') ?? '-',
                    'usr_deleted_at' => optional($user->usr_deleted_at)->format('d/m/Y H:i') ?? '-',
                    default => $user->{$col}
                };
            })
            ->toArray();
    }
}
