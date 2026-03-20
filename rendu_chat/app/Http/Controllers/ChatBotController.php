<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ChatBotController extends Controller
{
    /**
     * Affiche la page du chatbot
     */
    public function index()
    {
        return view('chatbot.index');
    }

    /**
     * Envoie un message et retourne la réponse de l'IA
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

   
        $history = Session::get('chat_history', []);

 
        $history[] = [
            'role' => 'user',
            'content' => $request->message,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type'  => 'application/json',
                'HTTP-Referer'  => config('app.url'),  // Optionnel mais recommandé par OpenRouter
                'X-Title'       => config('app.name'), // Optionnel
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => env('OPENROUTER_MODEL', 'mistralai/mistral-small-2603'),
                'messages' => array_merge(
                    [
                        [
                            'role'    => 'system',
                            'content' =>  'Tu t\'appelles Lola tu es une assistante spécialisé dans les arts créatifs. Tu es enjouée, 
                                            bienveillante et passionnée par les activités créatives comme la broderie et la couture. 
                                            Réponds toujours en français avec enthousiasme.',
                        ],
                    ],
                    $history
                ),
                'max_tokens'  => 1024,
                'temperature' => 0.7,
            ]);

            if ($response->failed()) {
                return response()->json([
                    'error' => 'Erreur API : ' . $response->body(),
                ], 500);
            }

            $data = $response->json();
            $assistantMessage = $data['choices'][0]['message']['content'] ?? 'Aucune réponse reçue.';

            // Ajoute la réponse de l'assistant à l'historique
            $history[] = [
                'role'    => 'assistant',
                'content' => $assistantMessage,
            ];

            // Limite l'historique à 20 messages pour éviter de dépasser les tokens
            if (count($history) > 20) {
                $history = array_slice($history, -20);
            }

            // Sauvegarde l'historique en session
            Session::put('chat_history', $history);

            return response()->json([
                'message' => $assistantMessage,
                'model'   => $data['model'] ?? 'unknown',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur serveur : ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Réinitialise la conversation
     */
    public function clearHistory()
    {
        Session::forget('chat_history');

        return response()->json(['success' => true, 'message' => 'Conversation réinitialisée.']);
    }
}
