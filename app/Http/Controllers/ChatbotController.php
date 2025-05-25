<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function index()
    {
        // Initialiser la conversation si elle n'existe pas
        if (!session()->has('conversation')) {
            session(['conversation' => []]);
        }
        
        return view('chatbot');
    }

    public function ask(Request $request)
    {
        ini_set('max_execution_time', 300);

        $question = $request->input('question');

        if (!$question) {
            return back()->with('error', 'Veuillez poser une question.');
        }

        // Ajouter la question à l'historique
        $conversation = session('conversation', []);
        $conversation[] = [
            'type' => 'question',
            'content' => $question,
            'time' => now()
        ];
        session(['conversation' => $conversation]);

        // Chemin complet du script
        $scriptPath = base_path('python-chatbot/chat.py');
        $pythonPath = 'py -3.10';

        // Protège la question
        $escapedQuestion = escapeshellarg($question);

        // Commande complète
        $command = "$pythonPath \"$scriptPath\" $escapedQuestion";

        // Exécute la commande
        exec($command, $output, $status);

        if ($status !== 0) {
            Log::error('Erreur exécution Python', [
                'commande' => $command,
                'status' => $status,
                'output' => $output
            ]);
            
            // Ajouter l'erreur à l'historique
            $conversation = session('conversation', []);
            $conversation[] = [
                'type' => 'error',
                'content' => 'Erreur lors de la génération de la réponse.',
                'time' => now()
            ];
            session(['conversation' => $conversation]);
            
            return back();
        }

        // Fusionne la sortie et force l'encodage en UTF-8
        $answer = implode("\n", $output);
        $answer = iconv(mb_detect_encoding($answer, mb_detect_order(), true), "UTF-8//IGNORE", $answer);

        // Ajouter la réponse à l'historique
        $conversation = session('conversation', []);
        $conversation[] = [
            'type' => 'answer',
            'content' => $answer,
            'time' => now()
        ];
        session(['conversation' => $conversation]);

        return back();
    }

    // Optionnel: Pour vider l'historique
    public function clearHistory()
    {
        session(['conversation' => []]);
        return back();
    }
}