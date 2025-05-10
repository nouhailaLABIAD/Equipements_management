<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'état de l'équipement : {{ $equipement->reference }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded p-6">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('technicien.equipements.updateEtat', $equipement->id) }}">
                @csrf

                <div class="mb-4">
                    <label for="etat" class="block text-gray-700 font-bold mb-2">État :</label>
                    <select name="etat" id="etat" class="w-full border border-gray-300 rounded px-3 py-2">
                        @foreach(['neuf', 'bon état', 'Affecté', 'Non affecté', 'hors service'] as $etat)
                            <option value="{{ $etat }}" {{ $equipement->etat == $etat ? 'selected' : '' }}>
                                {{ ucfirst($etat) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
