<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Affecter un équipement') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('technicien.affectations.store') }}">
                @csrf

                <input type="hidden" name="equipement_id" value="{{ $equipement->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Équipement</label>
                    <input type="text" value="{{ $equipement->reference }} - {{ $equipement->marque }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" disabled>
                </div>

                <div class="mb-4">
                    <label for="member_id" class="block text-sm font-medium text-gray-700">Membre</label>
                    <select name="member_id" id="member_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        <option value="">-- Sélectionner un membre --</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->nom }} {{ $member->prenom }} ({{ $member->matricule }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Technicien</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        @foreach($techniciens as $technicien)
                            <option value="{{ $technicien->id }}">{{ $technicien->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="date_affectation" class="block text-sm font-medium text-gray-700">Date d'affectation</label>
                    <input type="date" name="date_affectation" id="date_affectation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">Valider l'affectation</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
