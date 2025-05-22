<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{

     public function index()
    {
        return view('chatbot');
    }
   public function ask(Request $request)
{
    ini_set('max_execution_time', 300);

    $question = $request->input('question');

    if (!$question) {
        return back()->with('error', 'Veuillez poser une question.');
    }

    // Chemin complet du script
    $scriptPath = base_path('python-chatbot/chat.py');
    $pythonPath = 'py -3.10'; // ou 'python3' si tu es sous Linux/Mac

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
        return back()->with('error', 'Erreur lors de la génération de la réponse.');
    }

    // Fusionne la sortie et force l'encodage en UTF-8
    $answer = implode("\n", $output);
    $answer = iconv(mb_detect_encoding($answer, mb_detect_order(), true), "UTF-8//IGNORE", $answer);

    return back()->with('answer', $answer);
}


}
