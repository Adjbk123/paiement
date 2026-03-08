<?php

namespace App\Exports;

use App\Models\PaiementInscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaiementsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = PaiementInscription::with([
            'enseignement',
            'option',
            'formation',
            'circonscription',
            'province',
            'region'
        ])->where('status', 'approved');

        if ($this->date) {
            $query->whereDate('created_at', $this->date);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Prénoms',
            'Email',
            'Téléphone',
            'Enseignement',
            'Option',
            'Montant (FCFA)',
            'Date'
        ];
    }

    public function map($inscription): array
    {
        return [
            $inscription->nom,
            $inscription->prenoms,
            $inscription->email,
            $inscription->phone,
            optional($inscription->enseignement)->nom == 'Autre'
                ? $inscription->autre_enseignement
                : optional($inscription->enseignement)->nom,
            optional($inscription->option)->nom,
            $inscription->montant,
            $inscription->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        $sheet->getStyle('A1:H1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFCCE5FF');

        $sheet->getStyle('G:H')->getAlignment()->setHorizontal('center');

        foreach(range('A','H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('G2:G' . $highestRow)
              ->getNumberFormat()
              ->setFormatCode('#,##0 "FCFA"');
    }
}
