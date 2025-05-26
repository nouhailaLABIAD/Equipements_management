<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historique des actions des techniciens') }}
        </h2>
    </x-slot>
<div class="px-6 py-4 text-center">
    <h2 class="text-2xl font-medium text-gray-900" style="font-family: Verdana; font-size: 23px; padding: 10px;">
        Historique des actions des techniciens
    </h2>
</div>
    <div class="py-6 px-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($logs as $log)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->action }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->route }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
