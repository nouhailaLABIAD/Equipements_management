<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Stocks') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
         <div class="flex justify-between mb-4 items-center">
        <!-- Formulaire de recherche -->
        <form method="GET" action="{{ route('stocks.index') }}" class="flex space-x-2 w-2/3">
            <input
    type="text"
    name="search"
    placeholder="Rechercher par type ou référence..."
    value="{{ request('search') }}"
    class="border rounded px-4 py-2" 
    style="width: 500px;"  
/>
 
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-bold px-4 rounded">
                 <i class="fas fa-search"></i> 
            </button>
        </form>

        <!-- Bouton Ajouter un stock -->
        <!-- Bouton Ajouter un stock -->
        <a href="{{ route('admin.stocks.create') }}" 
        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-black font-semibold py-2 px-4 rounded shadow transition">
            <i class="fas fa-plus"></i> Ajouter un stock
        </a>

    </div>
    <div class="px-6 py-4 text-center">
    <h2 class="text-2xl font-medium text-gray-900" style="font-family: Verdana; font-size: 23px; padding: 10px;">
        Liste des stocks
    </h2>
</div> 

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
             
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référence</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Configuration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'arrivée</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° de marché </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($stocks as $stock)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->type_equipement }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->configuration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->quantite }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->date_arrivee }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $stock->numero_marche }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-6">
                                            <!-- Modifier -->
                                            <a href="{{ route('admin.stocks.edit', $stock->id) }}" class="text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-edit text-blue-600 hover:text-blue-800"></i>
                                            </a>

                                            <!-- Supprimer -->
                                            <form action="{{ route('admin.stocks.destroy', $stock->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 delete-button" data-name="{{ $stock->reference }}">
                                                    <i class="fas fa-trash-alt text-red-600 hover:text-red-800"></i>
                                                </button>
                                            </form>


                                        </div>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <div class="mt-6">
                <div class="bg-gray-100 rounded-lg shadow p-2">
                {{ $stocks->links() }}
                </div>
            </div>

        </div> 
        
    </div>
    <div class="flex justify-end space-x-4 mb-4">
    <a href="{{ route('admin.stocks.export.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-file-pdf"></i> Exporter PDF
    </a>
    <a href="{{ route('admin.stocks.export.excel') }}" class="bg-green-600 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
         <i class="fas fa-file-excel"></i> Exporter Excel
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
                    text: `Voulez-vous vraiment supprimer le stock : ${name} ?`,
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
