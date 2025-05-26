<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Membres') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="flex justify-between mb-6 items-center">
            <!-- Formulaire de recherche -->
            <form method="GET" action="{{ route('members.index') }}" class="flex items-center space-x-2 w-full md:w-auto">
                <input type="text" 
                       name="search" 
                       placeholder="Rechercher par nom, prénom ou matricule"
                       value="{{ request('search') }}"
                       class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
                       style="width: 500px;">
                <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-search"></i> 
                </button>
            </form>

            <!-- Bouton Ajouter un membre -->
            <a href="{{ route('technicien.members.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-black font-medium py-2 px-4 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-plus"></i> Ajouter un Membre
            </a>
        </div>

        <div class="px-6 py-4 text-center">
            <h2 class="text-2xl font-bold text-gray-800" style="font-family: Verdana; padding: 10px 0;">
                Liste des membres
            </h2>
        </div>

        <div class="overflow-hidden shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Prénom</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Matricule</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Centre</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Équipements Affectés</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($members as $member)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $member->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $member->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $member->matricule }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $member->centre }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <a href="{{ route('technicien.members.equipements', $member->id) }}" class="text-black-900 hover:text-green-800 transition duration-150">
                                Voir équipements
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <div class="flex space-x-4">
                                <a href="{{ route('technicien.members.edit', $member->id) }}" class="text-black-600 hover:text-indigo-800 transition duration-150">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('technicien.members.destroy', $member->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 delete-button" data-name="{{ $member->nom }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<style>
    input:focus {
        outline: none;
        border-color: #9e2a5b;
        box-shadow: 0 0 0 3px rgba(158, 42, 91, 0.1);
        transition: all 0.2s ease-in-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Confirmer la suppression',
                    text: `Voulez-vous vraiment supprimer le membre : ${name} ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>