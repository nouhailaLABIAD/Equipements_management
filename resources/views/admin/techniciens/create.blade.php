<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un technicien') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.techniciens.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <!-- Rôle technicien fixé automatiquement -->
                <input type="hidden" name="role" value="technicien">

                <div class="flex justify-end">
                    <a href="{{ route('techniciens.index') }}" class="mr-4 bg-gray-200 px-4 py-2 rounded">Annuler</a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-black font-bold px-4 py-2 rounded">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
