<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Affecter un équipement') }}
        </h2>
    </x-slot>

    <!-- Tom Select (version locale, sans AJAX) -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<div class="px-6 py-4 text-center">
    <h2 class="text-2xl font-medium text-gray-900" style="font-family: Verdana; font-size: 23px; padding: 10px;">
Compléter l'affectation     </h2>
</div> 
    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('technicien.affectations.store') }}">
                @csrf

                <!-- ID équipement caché -->
                <input type="hidden" name="equipement_id" value="{{ $equipement->id }}">

                <!-- Équipement affiché -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Équipement</label>
                    <input type="text" value="{{ $equipement->reference }} - {{ $equipement->marque }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" disabled>
                </div>

                <!-- Membre avec filtre local -->
                <div class="mb-4">
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Membre</label>
                    <select name="member_id" id="member_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">-- Sélectionner un membre --</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">
                                {{ $member->nom }} {{ $member->prenom }} ({{ $member->matricule }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Technicien automatiquement détecté -->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Technicien</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" disabled>
                </div>

                <!-- Date -->
                <div class="mb-4">
                    <label for="date_affectation" class="block text-sm font-medium text-gray-700">Date d'affectation</label>
                    <input type="date" name="date_affectation" id="date_affectation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Bouton -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">Valider l'affectation</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Initialisation Tom Select -->
    <script>
        new TomSelect("#member_id", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            placeholder: "Rechercher un membre...",
        });
    </script>
</x-app-layout>
