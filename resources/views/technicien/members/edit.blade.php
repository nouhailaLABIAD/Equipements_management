<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un membre
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('technicien.members.update', $member->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="member_id" value="{{ request()->member_id }}">

                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $member->nom) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $member->prenom) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                    <input type="text" name="matricule" id="matricule" value="{{ old('matricule', $member->matricule) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="centre" class="block text-sm font-medium text-gray-700">Centre</label>
                    <input type="text" name="centre" id="centre" value="{{ old('centre', $member->centre) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('members.index') }}" class="mr-4 bg-gray-200 px-4 py-2 rounded">Annuler</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>