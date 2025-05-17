<?php
namespace App\Exports;

use App\Models\Equipement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EquipementsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Equipement::with('stock')->get();
    }

    public function map($equipement): array
    {
        return [
            $equipement->marque,
            $equipement->reference,
            $equipement->configuration,
            $equipement->date_acquisition,
            $equipement->etat,
            $equipement->stock->type_equipement ?? '',
            $equipement->stock->numero_marche ?? '',
        ];
    }

    public function headings(): array
    {
        return ['Marque', 'Référence', 'Configuration', 'Date acquisition', 'État', 'Type équipement', 'N° Marché'];
    }
}
