<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Equipements') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
         <div class="flex justify-between mb-4 items-center">
    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('equipements.index') }}" class="flex flex-grow items-center space-x-2">
        <input
            type="text"
            name="search"
            placeholder="Rechercher par marque, référence ou état..."
            value="{{ request('search') }}"
            class="border rounded px-4 py-2" 
    style="width: 500px;" 
        />
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded">
            🔍
        </button>
    </form>

    <!-- Bouton Ajouter -->
    <a href="{{ route('admin.equipements.create') }}" 
       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-black font-semibold py-2 px-4 rounded shadow transition">
        + Ajouter un équipement
    </a>
</div>

        


        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marque</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Configuration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'Acquisition</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                        <th class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type d'équipement
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            N° Marché
                        </th>
                        <th class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Historique</th>
                        <th class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">Actions</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($equipements as $equipement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $equipement->marque }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $equipement->reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $equipement->configuration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $equipement->date_acquisition }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $equipement->etat }}</td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $equipement->stock?->type_equipement ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $equipement->stock?->numero_marche ?? '—' }}
                            </td>
                            <td>
                                <a href="{{ route('historiques.index', $equipement->id) }}" class="text-blue-500">
                                Voir l'historique
                            </a>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
    <div class="flex items-center space-x-4">
        <!-- Modifier -->
        <a href="{{ route('admin.equipements.edit', $equipement->id) }}" 
           class="text-blue-600 hover:text-blue-800"
           title="Modifier">
            <i class="fas fa-edit fa-fw"></i>
        </a>

        <!-- Supprimer -->
        <form action="{{ route('admin.equipements.destroy', $equipement->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="text-red-600 hover:text-red-800 delete-button" 
                    data-name="{{ $equipement->reference }}"
                    title="Supprimer">
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

    <div class="flex justify-end space-x-4 mb-4">
        <a href="{{ route('equipements.export.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            📄 Exporter PDF
        </a>
        <a href="{{ route('equipements.export.excel') }}" class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
            📊 Exporter Excel
        </a>
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
                e.preventDefault(); // Empêche la soumission immédiate
                const form = this.closest('form');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Confirmer la suppression',
                    text: `Voulez-vous vraiment supprimer l'équipement : ${name} ?`,
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
