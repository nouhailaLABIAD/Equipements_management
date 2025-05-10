<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un équipement') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <form action="{{ route('equipements.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Marque -->
                <div class="mb-4">
                    <label for="marque" class="block text-sm font-medium text-gray-700">Marque</label>
                    <input type="text" name="marque" id="marque" class="mt-1 block w-full" required>
                </div>

                <!-- Référence -->
                <div class="mb-4">
                    <label for="reference" class="block text-sm font-medium text-gray-700">Référence</label>
                    <input type="text" name="reference" id="reference" class="mt-1 block w-full" required>
                </div>

                <!-- Configuration -->
                <div class="mb-4">
                    <label for="configuration" class="block text-sm font-medium text-gray-700">Configuration</label>
                    <input type="text" name="configuration" id="configuration" class="mt-1 block w-full" required>
                </div>

                <!-- Date d'acquisition -->
                <div class="mb-4">
                    <label for="date_acquisition" class="block text-sm font-medium text-gray-700">Date d'acquisition</label>
                    <input type="date" name="date_acquisition" id="date_acquisition" class="mt-1 block w-full" required>
                </div>

                <!-- Etat (Liste déroulante) -->
                <div class="mb-4">
                    <label for="etat" class="block text-sm font-medium text-gray-700">État</label>
                    <select name="etat" id="etat" class="mt-1 block w-full" required>
                        <option value="neuf">Neuf</option>
                        <option value="bon état">Bon état</option>
                        <option value="Affecté">Affecté</option>
                        <option value="Non affecté">Non affecté</option>
                        <option value="hors service">Hors service</option>
                    </select>
                </div>

                <!-- Stock (Liste déroulante) -->
                <div class="mb-4">
                    <label for="stock_id" class="block text-sm font-medium text-gray-700">Stock</label>
                    <select name="stock_id" id="stock_id" class="mt-1 block w-full" required>
                        @foreach ($stocks as $stock)
                            <option value="{{ $stock->id }}">{{ $stock->type_equipement }} - {{ $stock->reference }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-black py-2 px-4 rounded">Ajouter</button>
            </div>
        </form>
    </div>
</x-app-layout>
