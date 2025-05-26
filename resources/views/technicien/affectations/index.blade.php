<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('Liste des équipements non affectés') }}
            </h2>
        </div>
    </x-slot>
 <div class="px-6 py-4 text-center">
    <h2 class="text-2xl font-medium text-gray-900" style="font-family: Verdana; font-size: 23px; padding: 10px;">
Liste des équipements non affectés
    </h2>
</div> 
    <div class="pb-8 pt-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Marque</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Référence</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Configuration</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Date d'acquisition</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">État</th>
                                <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($equipements as $equipement)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-900">
                                    {{ $equipement->marque }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-600">
                                    {{ $equipement->reference }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-600">
                                    {{ $equipement->configuration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-600">
                                    {{ $equipement->date_acquisition }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                    {{ $equipement->etat == 'neuf' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ $equipement->etat }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-base text-gray-600">
                                    <a href="{{ route('technicien.affectations.create', $equipement->id) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150">
                                        <i class="fas fa-user-plus mr-2"></i> Affecter
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>