<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historique des affectations de {{ $equipement->marque }} ({{ $equipement->reference }})
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('equipements.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste des équipements
        </a>


        <div class="mt-4">
            @if($equipement->affectations->isEmpty())
                <p class="text-gray-600">Aucune affectation trouvée pour cet équipement.</p>
            @else
                <table class="min-w-full bg-white border mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border">Membre</th>
                            <th class="px-4 py-2 border">Technicien</th>
                            <th class="px-4 py-2 border">Date d'affectation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipement->affectations as $affectation)
                            <tr>
                                <td class="px-4 py-2 border">
                                    {{ $affectation->member->prenom }} {{ $affectation->member->nom }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $affectation->user->name }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ \Carbon\Carbon::parse($affectation->date_affectation)->format('d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="flex justify-end space-x-4 my-4">
            <a href="{{ route('historiques.export.pdf', $equipement->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                📄 Exporter PDF
            </a>
            <a href="{{ route('historiques.export.excel', $equipement->id) }}" class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                📊 Exporter Excel
            </a>
        </div>

    </div>
</x-app-layout>
