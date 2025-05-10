<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Équipements affectés à {{ $member->prenom }} {{ $member->nom }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('members.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                <i class="fas fa-arrow-left mr-2"></i> Retour aux membres
            </a>

            <div class="mt-4">
                @if($equipements->isEmpty())
                    <p class="text-gray-600">Aucun équipement affecté à ce membre.</p>
                @else
                    <table class="min-w-full bg-white border border-gray-200 mt-2">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Marque</th>
                                <th class="py-2 px-4 border-b">Etat</th>
                                <th class="py-2 px-4 border-b">Référence</th>
                                <th class="py-2 px-4 border-b">Date d'Affectation</th>
                                <th class="py-2 px-4 border-b">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipements as $equipement)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $equipement->marque }}</td>
                                    <td class="py-2 px-4 border-b">{{ $equipement->etat }}</td>
                                    <td class="py-2 px-4 border-b">{{ $equipement->reference }}</td>
                                    <td class="py-2 px-4 border-b">
    @if($equipement->derniereAffectation)
        {{ $equipement->derniereAffectation->created_at->format('d/m/Y') }}
    @else
        <em>Aucune affectation</em>
    @endif
</td>
                                    <td class="py-2 px-4 border-b">
                                        <a href="{{ route('technicien.equipements.editEtat', $equipement->id) }}" class="text-blue-600">
                                            <i class="fas fa-edit"></i> Modifier l'état
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
