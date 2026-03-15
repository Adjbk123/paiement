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
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
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
        ]);

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        } else {
            $query->whereIn('status', ['approved', 'partiel']);
        }

        if (!empty($this->filters['enseignement'])) {
            if ($this->filters['enseignement'] == 'autre') {
                $query->whereNotNull('autre_enseignement');
            } else {
                $query->where('enseignement_id', $this->filters['enseignement']);
            }
        }
        if (!empty($this->filters['circonscription'])) { $query->where('circonscription_id', $this->filters['circonscription']); }
        if (!empty($this->filters['formation'])) { $query->where('formation_id', $this->filters['formation']); }
        if (!empty($this->filters['region'])) { $query->where('region_id', $this->filters['region']); }
        if (!empty($this->filters['option'])) { $query->where('option_id', $this->filters['option']); }
        if (!empty($this->filters['date_paiement'])) { $query->whereDate('created_at', $this->filters['date_paiement']); }

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
            'Formation (CS)',
            'Commune (Région)',
            'Statut',
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
            optional($inscription->formation)->nom,
            optional($inscription->region)->nom,
            ucfirst($inscription->status),
            $inscription->montant,
            $inscription->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);

        $sheet->getStyle('A1:K1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFCCE5FF');

        $sheet->getStyle('J:K')->getAlignment()->setHorizontal('center');

        foreach(range('A','K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('J2:J' . $highestRow)
              ->getNumberFormat()
              ->setFormatCode('#,##0 "FCFA"');
    }
}
