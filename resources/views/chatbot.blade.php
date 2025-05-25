<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chatbot') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6 flex flex-col h-[600px]">
            <!-- Titre du chatbot -->
            <div class="text-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Chatbot</h3>
                <p class="text-gray-500">Comment puis-je vous aider aujourd'hui ?</p>
            </div>

            <!-- Zone de conversation -->
            <div id="chat-container" class="flex-1 overflow-y-auto mb-6 space-y-4">
                <!-- Message d'accueil du chatbot -->
                <div class="flex items-start">
                    <div class="bg-blue-100 rounded-lg p-4 max-w-[70%]">
                        <p class="text-gray-800">Hey there</p>
                        <p class="text-gray-800">How can I help you today?</p>
                    </div>
                </div>

                <!-- Historique de la conversation -->
                @foreach (session('conversation', []) as $message)
                    @if ($message['type'] === 'question')
                        <!-- Question de l'utilisateur (droite) -->
                        <div class="flex items-start justify-end">
                            <div class="bg-gray-200 rounded-lg p-4 max-w-[70%]">
                                <p class="text-gray-800">{{ $message['content'] }}</p>
                                <p class="text-xs text-gray-500 text-right mt-1">{{ $message['time']->format('H:i') }}</p>
                            </div>
                        </div>
                    @elseif ($message['type'] === 'answer')
                        <!-- Réponse du chatbot (gauche) -->
                        <div class="flex items-start">
                            <div class="bg-blue-100 rounded-lg p-4 max-w-[70%]">
                                <p class="text-gray-800">{!! nl2br(e($message['content'])) !!}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $message['time']->format('H:i') }}</p>
                            </div>
                        </div>
                    @elseif ($message['type'] === 'error')
                        <!-- Message d'erreur -->
                        <div class="flex items-start">
                            <div class="bg-red-100 rounded-lg p-4 max-w-[70%]">
                                <p class="text-red-800">{{ $message['content'] }}</p>
                                <p class="text-xs text-red-500 mt-1">{{ $message['time']->format('H:i') }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Formulaire d'envoi -->
            <form method="POST" action="{{ route('chatbot.ask') }}" class="mt-auto">
                @csrf
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        name="question" 
                        placeholder="Type your message here..." 
                        required
                        class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full"
                    >
                        Envoyer
                    </button>
                </div>
            </form>

            <!-- Optionnel: Bouton pour vider l'historique -->
            <form method="POST" action="{{ route('chatbot.clearHistory') }}" class="mt-2">
                @csrf
                <button 
                    type="submit" 
                    class="text-sm text-gray-500 hover:text-gray-700"
                >
                    Effacer l'historique
                </button>
            </form>
        </div>
    </div>

    <!-- Script pour faire défiler vers le bas automatiquement -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatContainer = document.getElementById('chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
</x-app-layout>