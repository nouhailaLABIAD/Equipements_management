<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un stock') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.stocks.update', $stock->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="type_equipement" class="block text-sm font-medium text-gray-700">Type d'équipement</label>
                    <input type="text" name="type_equipement" id="type_equipement" value="{{ old('type_equipement', $stock->type_equipement) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="reference" class="block text-sm font-medium text-gray-700">Référence</label>
                    <input type="text" name="reference" id="reference" value="{{ old('reference', $stock->reference) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="configuration" class="block text-sm font-medium text-gray-700">Configuration</label>
                    <input type="text" name="configuration" id="configuration" value="{{ old('configuration', $stock->configuration) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité</label>
                    <input type="number" name="quantite" id="quantite" value="{{ old('quantite', $stock->quantite) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="date_arrivee" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                    <input type="date" name="date_arrivee" id="date_arrivee" value="{{ old('date_arrivee', $stock->date_arrivee) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('stocks.index') }}" class="mr-4 bg-gray-200 px-4 py-2 rounded">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
