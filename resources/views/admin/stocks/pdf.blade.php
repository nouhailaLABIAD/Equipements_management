<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stocks PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Liste des Stocks</h2>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Référence</th>
                <th>Configuration</th>
                <th>Quantité</th>
                <th>Date d'arrivée</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->type_equipement }}</td>
                    <td>{{ $stock->reference }}</td>
                    <td>{{ $stock->configuration }}</td>
                    <td>{{ $stock->quantite }}</td>
                    <td>{{ $stock->date_arrivee }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
