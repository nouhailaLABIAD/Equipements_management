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
                <div class="mb-4">
                    <label for="numero_marche" class="block font-medium text-gray-700">Numéro de marché</label>
                    <input type="text" name="numero_marche" id="numero_marche" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                        Ajouter
                    </button>
                </div>

            </form>
            
            <!-- FORMULAIRE D'IMPORT EXCEL -->
        <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Importer plusieurs stocks via un fichier Excel</h3>
            <form action="{{ route('stocks.importExcel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center space-x-4">
                    <input type="file" name="excel_file" accept=".xlsx,.xls"
                           class="border border-gray-300 rounded px-3 py-2 w-full" required>
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                        📥 Importer Excel
                    </button>
                    <a href="{{ asset('exemples/stocks.xlsx') }}"
               class="bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded"
               download>
                📄 Télécharger modèle
            </a>
                </div>
            </form>
        </div>

        </div>
    </div>
</x-app-layout>
<style>
    input:focus {
    outline: none !important;
    border-color: #9e2a5b !important;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.2) !important;
}
</style>