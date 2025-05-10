<?php

namespace App\Exports;

use App\Models\Affectation;
use App\Models\Equipement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class HistoriqueExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    protected $equipementId;

    public function __construct($equipementId)
    {
        $this->equipementId = $equipementId;
    }

    public function collection()
    {
        $equipement = Equipement::with('affectations.member', 'affectations.user')->findOrFail($this->equipementId);
        return $equipement->affectations->map(function ($affectation) {
            return [
                'Membre' => $affectation->member->prenom . ' ' . $affectation->member->nom,
                'Technicien' => $affectation->user->name,
                'Date d\'affectation' => $affectation->date_affectation,
            ];
        });
    }

    public function headings(): array
    {
        return ['Membre', 'Technicien', 'Date d\'affectation'];
    }
}
