<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
   

    // Liste toutes les conversations de l'utilisateur connecté
    public function index()
    {
        $this->updateLastSeen();

        $me = Auth::user();

        // Tous les utilisateurs sauf moi
        $users = User::where('id', '!=', $me->id)->get()->map(function ($user) use ($me) {
            $user->unread_count = Message::where('sender_id', $user->id)
                ->where('receiver_id', $me->id)
                ->whereNull('read_at')
                ->count();

            $user->last_message = Message::conversation($me->id, $user->id)
                ->latest()
                ->first();

            return $user;
        })->sortByDesc(fn($u) => optional($u->last_message)->created_at);

        return view('chat.index', compact('users'));
    }

    // Affiche la conversation avec un utilisateur
    public function show(User $user)
    {
        $this->updateLastSeen();

        $me = Auth::user();

        // Marquer les messages reçus comme lus
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $me->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $messages = Message::conversation($me->id, $user->id)->get();

        return view('chat.show', compact('user', 'messages'));
    }

    // Envoie un message
    public function store(Request $request, User $user)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user->id,
            'body'        => $request->body,
        ]);

        return redirect()->route('chat.show', $user);
    }

    // Polling AJAX — retourne les nouveaux messages depuis un ID donné
    public function poll(User $user, Request $request)
    {
        $this->updateLastSeen();

        $me = Auth::id();
        $lastId = $request->integer('last_id', 0);

        $messages = Message::conversation($me, $user->id)
            ->where('id', '>', $lastId)
            ->get()
            ->map(fn($m) => [
                'id'         => $m->id,
                'body'       => e($m->body),
                'mine'       => $m->sender_id === $me,
                'created_at' => $m->created_at->format('H:i'),
            ]);

        // Marquer comme lus
        Message::where('sender_id', $user->id)
            ->where('receiver_id', $me)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'messages' => $messages,
            'online'   => $user->isOnline(),
        ]);
    }

    private function updateLastSeen(): void
    {
        Auth::user()->update(['last_seen_at' => now()]);
    }
}
