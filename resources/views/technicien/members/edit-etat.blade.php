<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Modifier l'état de l'équipement : {{ $equipement->reference }}
        </h2>
    </x-slot>
<div class="px-6 py-4 text-center">
            <h2 class="text-2xl font-bold text-gray-800" style="font-family: Verdana; padding: 10px 0;">
                Modifier l'état de l'équipement : {{ $equipement->reference }}
            </h2>
        </div>
    <div class="py-8">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('technicien.equipements.updateEtat', $equipement->id) }}">
                    @csrf

                    <div class="mb-6">
                        <label for="etat" class="block text-sm font-medium text-gray-700 mb-2">État de l'équipement</label>
                        <select name="etat" id="etat" 
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-lg transition duration-150">
                            @foreach(['neuf', 'bon état', 'Affecté', 'Non affecté', 'hors service'] as $etat)
                                <option value="{{ $etat }}" {{ $equipement->etat == $etat ? 'selected' : '' }} class="py-1">
                                    {{ ucfirst($etat) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-black hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                            <i class="fas fa-save mr-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>