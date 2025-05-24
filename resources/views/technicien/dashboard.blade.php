<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard-Technicien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200">

                <!-- Statistiques équipements -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div class="bg-red-50 p-6 rounded-xl shadow-sm border border-red-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-red-100 text-red-800 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-red-600">Équipements affectés</div>
                                <div class="text-2xl font-bold text-red-800">{{ $equipementsAffectes }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-amber-50 p-6 rounded-xl shadow-sm border border-amber-100">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-amber-100 text-amber-800 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-amber-600">À vérifier / À réparer</div>
                                <div class="text-2xl font-bold text-amber-800">{{ $equipementsAvecProbleme }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste équipements affectés -->
                <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-red-50 to-white">
                        <h3 class="text-lg font-semibold text-red-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            Mes équipements affectés
                        </h3>
                    </div>
                    
                    <ul class="divide-y divide-gray-100 max-h-96 overflow-y-auto">
                        @foreach ($equipements as $equipement)
                            <li class="px-6 py-4 hover:bg-red-50 transition-colors duration-150">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="font-medium text-gray-800">
                                            {{ $equipement->marque }} 
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full 
                                                @if($equipement->etat === 'Neuf') bg-red-100 text-red-800
                                                @elseif($equipement->etat === 'Bon état') bg-amber-100 text-amber-800
                                                @elseif($equipement->etat === 'Hors service') bg-gray-100 text-gray-800
                                                @endif">
                                                {{ $equipement->etat }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Affecté le : {{ $equipement->affectations->first() ? $equipement->affectations->first()->created_at->format('d/m/Y') : 'N/A' }}
                                        </div>
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                    @if($equipements->isEmpty())
                        <div class="p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <p class="mt-2 text-gray-500">Aucun équipement affecté pour le moment</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>