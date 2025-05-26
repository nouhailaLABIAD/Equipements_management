<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Membre') }}
        </h2>
    </x-slot>
<div class="px-6 py-4 text-center">
            <h2 class="text-2xl font-bold text-gray-800" style="font-family: Verdana; padding: 10px 0;">
                Ajouter un membres
            </h2>
        </div>
    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('technicien.members.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                    <input type="text" name="matricule" id="matricule" value="{{ old('matricule') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="centre" class="block text-sm font-medium text-gray-700">Centre</label>
                    <input type="text" name="centre" id="centre" value="{{ old('centre') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black px-4 py-2 rounded">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
