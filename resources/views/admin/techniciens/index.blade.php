<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Techniciens') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
         <div class="flex justify-between mb-4 items-center">
    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('techniciens.index') }}" class="flex flex-grow items-center space-x-2">
        <input
            type="text"
            name="search"
            placeholder="Rechercher par nom ou email..."
            value="{{ request('search') }}"
            class="border rounded px-4 py-2" 
    style="width: 500px;" 
        />
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-bold px-4 py-2 rounded">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- Bouton Ajouter -->
    <a href="{{ route('admin.techniciens.create') }}" 
       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-black font-semibold py-2 px-4 rounded shadow transition">
        + Ajouter un technicien
    </a>
</div>

<div class="px-6 py-4 text-center">
    <h2 class="text-2xl font-medium text-gray-900" style="font-family: Verdana; font-size: 23px; padding: 10px;">
        Liste des techniciens
    </h2>
</div> 

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($techniciens as $tech)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tech->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $tech->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <!-- Modifier -->
                                    <a href="{{ route('admin.techniciens.edit', $tech->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit text-blue-600 hover:text-blue-800"></i>
                                    </a>

                                    <!-- Supprimer -->
                                    <form action="{{ route('admin.techniciens.destroy', $tech->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 delete-button" data-name="{{ $tech->name }}">
                                            <i class="fas fa-trash-alt fa-fw"></i>
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
    outline: none !important;
    border-color: #9e2a5b !important;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.2) !important;
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
                    text: `Voulez-vous vraiment supprimer le technicien : ${name} ?`,
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
