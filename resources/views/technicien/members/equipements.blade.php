<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Équipements affectés à {{ $member->prenom }} {{ $member->nom }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('members.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-black rounded-lg transition duration-200 mb-6">
                <i class="fas fa-arrow-left mr-2"></i> Retour aux membres
            </a>
<div class="px-6 py-4 text-center">
            <h2 class="text-2xl font-bold text-gray-800" style="font-family: Verdana; padding: 10px 0;">
                Équipements affectés à {{ $member->prenom }} {{ $member->nom }}
            </h2>
        </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                @if($equipements->isEmpty())
                    <div class="p-6 text-center text-gray-500">
                        Aucun équipement affecté à ce membre.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marque</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'affectation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($equipements as $equipement)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $equipement->marque }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $equipement->etat == 'neuf' ? 'bg-green-100 text-green-800' : 
                                               ($equipement->etat == 'bon état' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ $equipement->etat }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $equipement->reference }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($equipement->derniereAffectation)
                                            {{ $equipement->derniereAffectation->created_at->format('d/m/Y') }}
                                        @else
                                            <span class="text-gray-400">Aucune affectation</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('technicien.equipements.editEtat', $equipement->id) }}" 
                                           class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-black bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                            <i class="fas fa-edit mr-1"></i> Modifier
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>