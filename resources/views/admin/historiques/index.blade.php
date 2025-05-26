<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Historique des affectations de {{ $equipement->marque }} ({{ $equipement->reference }})
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="{{ route('equipements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-black rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
        </a>
  <div class="px-6 py-4 text-center">
    <h2 class="text-2xl font-medium text-gray-900" style="font-family: Verdana; font-size: 23px; padding: 10px;">
                   Historique des affectations de {{ $equipement->marque }} ({{ $equipement->reference }})

    </h2>
</div> 
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if($equipement->affectations->isEmpty())
                <div class="p-6 text-gray-500 text-center">
                    Aucune affectation trouvée pour cet équipement
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Membre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technicien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'affectation</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($equipement->affectations as $affectation)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $affectation->member->prenom }} {{ $affectation->member->nom }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $affectation->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($affectation->date_affectation)->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('historiques.export.pdf', $equipement->id) }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200">
                <i class="fas fa-file-pdf mr-2"></i> Exporter PDF
            </a>
            <a href="{{ route('historiques.export.excel', $equipement->id) }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-black rounded-lg transition duration-200">
                <i class="fas fa-file-excel mr-2"></i> Exporter Excel
            </a>
        </div>
    </div>
</x-app-layout>