<?php
namespace App\Exports;

use App\Models\Equipement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipementsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Equipement::select('marque', 'reference', 'configuration', 'date_acquisition', 'etat', 'stock_id')->get();
    }

    public function headings(): array
    {
        return ['Marque', 'Référence', 'Configuration', 'Date acquisition', 'État', 'Stock ID'];
    }
}
