<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Membres') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('technicien.members.create') }}" class="bg-blue-600 text-black px-4 py-2 rounded">Ajouter un Membre</a>

            <div class="mt-4">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Nom</th>
                            <th class="py-2 px-4 border-b">Prénom</th>
                            <th class="py-2 px-4 border-b">Matricule</th>
                            <th class="py-2 px-4 border-b">Centre</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                            <th class="py-2 px-4 border-b">Equipements affectés</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $member->nom }}</td>
                                <td class="py-2 px-4 border-b">{{ $member->prenom }}</td>
                                <td class="py-2 px-4 border-b">{{ $member->matricule }}</td>
                                <td class="py-2 px-4 border-b">{{ $member->centre }}</td>
                                <td class="py-2 px-4 border-b">
                                    <!-- Modifier avec icône -->
                                    <a href="{{ route('technicien.members.edit', $member->id) }}" class="text-blue-600">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Supprimer avec icône et SweetAlert -->
                                    <form action="{{ route('technicien.members.destroy', $member->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button text-red-600" data-name="{{ $member->nom }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <!-- Bouton Équipements -->
                                    <a href="{{ route('technicien.members.equipements', $member->id) }}" class="text-green-600">
                                        <i class="fas fa-tools"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                const name = this.getAttribute('data-name');

                // Affichage de la boîte de dialogue SweetAlert
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
                        form.submit(); // Soumettre le formulaire de suppression
                    }
                });
            });
        });
    });
</script>
