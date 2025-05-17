<?php

namespace App\Imports;

use App\Models\Equipement;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EquipementsImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use SkipsFailures;



public function model(array $row)
{
    Log::info('📥 Ligne reçue :', $row);

    $type = strtolower(trim($row['type_equipement']));
    $marche = strtolower(trim($row['numero_marche']));

    $stock = Stock::whereRaw('LOWER(type_equipement) = ?', [$type])
                  ->whereRaw('LOWER(numero_marche) = ?', [$marche])
                  ->first();

    if (!$stock) {
        Log::warning('❌ Stock introuvable pour : ' . $type . ', ' . $marche);
        return null;
    }

    try {
        // Si c'est un nombre, c'est une date Excel (format natif)
        if (is_numeric($row['date_acquisition'])) {
            $date = Date::excelToDateTimeObject($row['date_acquisition']);
        } else {
            $date = \DateTime::createFromFormat('d/m/Y', $row['date_acquisition']);
        }

        if (!$date) {
            Log::warning('❌ Format de date invalide : ' . $row['date_acquisition']);
            return null;
        }

    } catch (\Exception $e) {
        Log::error('❌ Erreur de conversion date : ' . $e->getMessage());
        return null;
    }

    return new Equipement([
        'marque'           => $row['marque'],
        'reference'        => $row['reference'],
        'configuration'    => $row['configuration'],
        'date_acquisition' => $date->format('Y-m-d'),
        'etat'             => $row['etat'],
        'stock_id'         => $stock->id,
    ]);
}

public function rules(): array
{
    return [
        '*.marque'           => ['required'],
        '*.reference'        => ['required'],
        '*.configuration'    => ['required'],
        '*.date_acquisition' => ['required'], // Ne pas mettre "date" ici
        '*.etat'             => ['required'],
        '*.type_equipement'  => ['required'],
        '*.numero_marche'    => ['required'],
    ];
}

}
