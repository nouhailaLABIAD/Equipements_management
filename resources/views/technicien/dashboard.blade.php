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
        <div class="bg-blue-100 p-4 rounded-xl shadow">
            <div class="text-sm text-blue-800">Équipements affectés</div>
            <div class="text-2xl font-bold text-blue-900">{{ $equipementsAffectes }}</div>
        </div>
        <div class="bg-yellow-100 p-4 rounded-xl shadow">
            <div class="text-sm text-yellow-800">À vérifier / À réparer</div>
            <div class="text-2xl font-bold text-yellow-900">{{ $equipementsAvecProbleme }}</div>
        </div>
    </div>

    <!-- Liste équipements affectés -->
    <div class="bg-white shadow rounded-xl p-4">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">🧰 Mes équipements affectés</h3>
        <ul class="divide-y divide-gray-200 max-h-64 overflow-y-auto">
            @forelse ($equipements as $equipement)
                <li class="py-2 flex justify-between items-center">
                    <span>{{ $equipement->nom }} - <span class="italic">{{ $equipement->etat }}</span></span>
                    <a href="{{ route('equipements.edit', $equipement->id) }}" class="text-blue-600 hover:underline text-sm">Modifier état</a>
                </li>
            @empty
                <li class="py-2 text-gray-500">Aucun équipement affecté.</li>
            @endforelse
        </ul>
    </div>

</div>

        </div>
    </div>
</x-app-layout>
