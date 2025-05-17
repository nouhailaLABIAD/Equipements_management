<?php
namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StocksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Stock::select('type_equipement', 'reference', 'configuration', 'numero_marche', 'quantite', 'date_arrivee')->get();
    }

    public function headings(): array
    {
        return ['Type Equipement', 'Référence', 'Configuration', 'N° Marché', 'Quantité', 'Date Arrivée'];
    }
}
