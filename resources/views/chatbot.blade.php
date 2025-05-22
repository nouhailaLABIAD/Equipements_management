<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chatbot') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">

            <h3 class="text-lg font-medium text-gray-900 mb-4">Posez votre question au chatbot</h3>

            <form method="POST" action="{{ route('chatbot.ask') }}">
                @csrf
                <input 
                    type="text" 
                    name="question" 
                    placeholder="Ex: Quelle est la fonction d’un routeur ?" 
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button 
                    type="submit" 
                    class="mt-3 bg-blue-600 hover:bg-blue-700 text-black font-semibold py-2 px-4 rounded"
                >
                    Envoyer
                </button>
            </form>

            @if (session('answer'))
                <div class="mt-6 bg-green-100 text-green-800 p-4 rounded">
                    <strong>Réponse :</strong><br>
                    {!! nl2br(e(session('answer'))) !!}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-6 bg-red-100 text-red-700 p-4 rounded">
                    <strong>Erreur :</strong><br>
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
