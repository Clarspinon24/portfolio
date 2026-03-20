<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-extrabold mb-6 bg-clip-text text-transparent"
            style="background-image: linear-gradient(90deg, #6366f1, #ec4899); -webkit-background-clip: text;">
             Mes conversations
        </h1>

        @if($users->isEmpty())
            <div class="text-center py-16 text-gray-400">
           
                <p class="font-semibold">Aucun utilisateur pour l'instant.</p>
            </div>
        @else
            <div class="space-y-2">
                @foreach($users as $user)
                <a href="{{ route('chat.show', $user) }}"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-gray-100 hover:border-indigo-200 hover:shadow-sm transition group">

                    {{-- Avatar --}}
                    <div class="relative shrink-0">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white text-lg"
                             style="background: linear-gradient(135deg, #6366f1, #ec4899);">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        {{-- Statut en ligne --}}
                        @if($user->isOnline())
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></span>
                        @endif
                    </div>

                    {{-- Infos --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">{{ $user->name }}</p>
                            @if($user->last_message)
                            <span class="text-xs text-gray-400">{{ $user->last_message->created_at->diffForHumans() }}</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-400 truncate mt-0.5">
                            @if($user->last_message)
                                @if($user->last_message->sender_id === Auth::id())
                                    <span class="text-indigo-400">Vous :</span>
                                @endif
                                {{ $user->last_message->body }}
                            @else
                                <span class="italic">Aucun message</span>
                            @endif
                        </p>
                    </div>

                    {{-- Badge non lu --}}
                    @if($user->unread_count > 0)
                    <span class="shrink-0 w-5 h-5 rounded-full text-white text-xs font-bold flex items-center justify-center"
                          style="background: linear-gradient(135deg, #6366f1, #ec4899);">
                        {{ $user->unread_count }}
                    </span>
                    @endif

                </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
