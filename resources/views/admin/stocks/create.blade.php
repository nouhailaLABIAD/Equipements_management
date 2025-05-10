<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Stock') }}
        </h2>
    </x-slot>

    <div class="py-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow" style="min-height: 400px; overflow-y: auto;">
        <form action="{{ route('admin.stocks.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="type_equipement" class="block font-medium text-gray-700">Type d'équipement</label>
                    <input type="text" name="type_equipement" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="reference" class="block font-medium text-gray-700">Référence</label>
                    <input type="text" name="reference" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="configuration" class="block font-medium text-gray-700">Configuration</label>
                    <input type="text" name="configuration" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="quantite" class="block font-medium text-gray-700">Quantité</label>
                    <input type="number" name="quantite" class="w-full border rounded px-3 py-2" required min="1">
                </div>

                <div class="mb-4">
                    <label for="date_arrivee" class="block font-medium text-gray-700">Date d'arrivée</label>
                    <input type="date" name="date_arrivee" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
