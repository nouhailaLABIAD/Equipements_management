<?php

namespace App\Imports;

use App\Models\Stock;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class StocksImport implements ToModel, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use SkipsFailures;

    public function model(array $row)
    {
        Log::info('📥 Ligne stock reçue : ' . json_encode($row));

        // Gérer les dates Excel (numériques)
        $date = null;
        if (is_numeric($row['date_arrivee'])) {
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_arrivee'])->format('Y-m-d');
        } else {
            $parsed = \DateTime::createFromFormat('d/m/Y', $row['date_arrivee']);
            if ($parsed) {
                $date = $parsed->format('Y-m-d');
            }
        }

        if (!$date) {
            Log::warning("❌ Format de date invalide : " . $row['date_arrivee']);
            return null;
        }

        return new Stock([
            'type_equipement'  => $row['type_equipement'],
            'reference'        => $row['reference'],
            'configuration'    => $row['configuration'],
            'quantite'         => $row['quantite'],
            'date_arrivee'     => $date,
            'numero_marche'    => $row['numero_marche'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.type_equipement' => ['required', 'string'],
            '*.reference'       => ['required', 'string'],
            '*.configuration'   => ['required', 'string'],
            '*.quantite'        => ['required', 'integer'],
            '*.date_arrivee'    => ['required'],
            '*.numero_marche'   => ['required', 'string'],
        ];
    }
}

