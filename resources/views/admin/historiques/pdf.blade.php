<h2>Historique des affectations de {{ $equipement->marque }} ({{ $equipement->reference }})</h2>

<table border="1" cellspacing="0" cellpadding="8">
    <thead>
        <tr>
            <th>Membre</th>
            <th>Technicien</th>
            <th>Date d'affectation</th>
        </tr>
    </thead>
    <tbody>
        @foreach($equipement->affectations as $affectation)
            <tr>
                <td>{{ $affectation->member->prenom }} {{ $affectation->member->nom }}</td>
                <td>{{ $affectation->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($affectation->date_affectation)->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
