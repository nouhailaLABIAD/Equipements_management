<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des équipements</title>
    <style>
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid black; padding: 4px; text-align: left; }
    </style>
</head>
<body>
    <h2>Liste des équipements</h2>
    <table>
        <thead>
            <tr>
                <th>Marque</th>
                <th>Référence</th>
                <th>Configuration</th>
                <th>Date acquisition</th>
                <th>État</th>
                <th>Stock</th>
                <th>N° Marché</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipements as $e)
                <tr>
                    <td>{{ $e->marque }}</td>
                    <td>{{ $e->reference }}</td>
                    <td>{{ $e->configuration }}</td>
                    <td>{{ $e->date_acquisition }}</td>
                    <td>{{ $e->etat }}</td>
                    <td>{{ $e->stock->type_equipement ?? '' }}</td>
                    <td>{{ $e->stock->numero_marche ?? '' }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
