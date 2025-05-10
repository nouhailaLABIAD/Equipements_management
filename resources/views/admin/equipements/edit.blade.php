<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un équipement') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.equipements.update', $equipement->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="marque" class="block text-sm font-medium text-gray-700">Marque</label>
                    <input type="text" name="marque" id="marque" value="{{ old('marque', $equipement->marque) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="reference" class="block text-sm font-medium text-gray-700">Référence</label>
                    <input type="text" name="reference" id="reference" value="{{ old('reference', $equipement->reference) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="configuration" class="block text-sm font-medium text-gray-700">Configuration</label>
                    <input type="text" name="configuration" id="configuration" value="{{ old('configuration', $equipement->configuration) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="date_acquisition" class="block text-sm font-medium text-gray-700">Date d'acquisition</label>
                    <input type="date" name="date_acquisition" id="date_acquisition" value="{{ old('date_acquisition', $equipement->date_acquisition) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="etat" class="block text-sm font-medium text-gray-700">État</label>
                    <select name="etat" id="etat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach(['neuf', 'bon état', 'Affecté', 'Non affecté', 'hors service'] as $etat)
                            <option value="{{ $etat }}" {{ old('etat', $equipement->etat) == $etat ? 'selected' : '' }}>
                                {{ $etat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="stock_id" class="block text-sm font-medium text-gray-700">Stock associé</label>
                    <select name="stock_id" id="stock_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @foreach($stocks as $stock)
                            <option value="{{ $stock->id }}" {{ old('stock_id', $equipement->stock_id) == $stock->id ? 'selected' : '' }}>
                                {{ $stock->reference }} ({{ $stock->type_equipement }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('equipements.index') }}" class="mr-4 bg-gray-200 px-4 py-2 rounded">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
