<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des équipements non affectés') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-4">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Marque</th>
                            <th class="py-2 px-4 border-b">Référence</th>
                            <th class="py-2 px-4 border-b">Configuration</th>
                            <th class="py-2 px-4 border-b">Date d'acquisition</th>
                            <th class="py-2 px-4 border-b">État</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipements as $equipement)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $equipement->marque }}</td>
                                <td class="py-2 px-4 border-b">{{ $equipement->reference }}</td>
                                <td class="py-2 px-4 border-b">{{ $equipement->configuration }}</td>
                                <td class="py-2 px-4 border-b">{{ $equipement->date_acquisition }}</td>
                                <td class="py-2 px-4 border-b">{{ $equipement->etat }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('technicien.affectations.create', $equipement->id) }}" class="bg-green-500 text-black px-3 py-1 rounded hover:bg-green-600">
                                        Affecter
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
