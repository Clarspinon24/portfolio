<x-app-layout>
<div class="max-w-2xl mx-auto py-10 px-4 flex flex-col" style="height: calc(100vh - 80px);">

    {{-- Header --}}
    <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100">
        <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-indigo-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div class="relative">
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white"
                 style="background: linear-gradient(135deg, #6366f1, #ec4899);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <span id="online-dot" class="absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white {{ $user->isOnline() ? 'bg-green-400' : 'bg-gray-300' }}"></span>
        </div>
        <div>
            <p class="font-bold text-gray-800">{{ $user->name }}</p>
            <p id="online-label" class="text-xs {{ $user->isOnline() ? 'text-green-500' : 'text-gray-400' }}">
                {{ $user->isOnline() ? 'En ligne' : 'Hors ligne' }}
            </p>
        </div>
    </div>

    {{-- Messages --}}
    <div id="messages" class="flex-1 overflow-y-auto space-y-3 pb-4 pr-1">
        @foreach($messages as $message)
        <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}" data-id="{{ $message->id }}">
            <div class="max-w-xs px-4 py-2 rounded-2xl text-sm
                {{ $message->sender_id === Auth::id()
                    ? 'text-white rounded-tr-sm'
                    : 'bg-gray-100 text-gray-700 rounded-tl-sm' }}"
                 @if($message->sender_id === Auth::id()) style="background: linear-gradient(135deg, #6366f1, #ec4899);" @endif>
                {{ $message->body }}
                <div class="text-xs mt-1 opacity-60 text-right">{{ $message->created_at->format('H:i') }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Formulaire d'envoi --}}
    <form method="POST" action="{{ route('chat.store', $user) }}" class="flex gap-3 pt-4 border-t border-gray-100">
        @csrf
        <input
            type="text"
            name="body"
            id="message-input"
            placeholder="Écrivez un message... 🐾"
            autocomplete="off"
            required
            class="flex-1 rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-400 transition"
        >
        <button type="submit"
                class="w-11 h-11 rounded-xl flex items-center justify-center text-white shrink-0 hover:opacity-90 transition active:scale-95"
                style="background: linear-gradient(135deg, #6366f1, #ec4899);">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
            </svg>
        </button>
    </form>
</div>

<script>
const messagesDiv = document.getElementById('messages');
const onlineDot = document.getElementById('online-dot');
const onlineLabel = document.getElementById('online-label');

// Scroll en bas au chargement
messagesDiv.scrollTop = messagesDiv.scrollHeight;

// Polling toutes les 3 secondes
let lastId = {{ $messages->last()?->id ?? 0 }};

function getLastId() {
    const items = messagesDiv.querySelectorAll('[data-id]');
    return items.length ? parseInt(items[items.length - 1].dataset.id) : lastId;
}

function addMessage(msg) {
    const div = document.createElement('div');
    div.className = `flex ${msg.mine ? 'justify-end' : 'justify-start'}`;
    div.dataset.id = msg.id;
    div.innerHTML = `
        <div class="max-w-xs px-4 py-2 rounded-2xl text-sm ${msg.mine ? 'text-white rounded-tr-sm' : 'bg-gray-100 text-gray-700 rounded-tl-sm'}"
             ${msg.mine ? 'style="background: linear-gradient(135deg, #6366f1, #ec4899);"' : ''}>
            ${msg.body}
            <div class="text-xs mt-1 opacity-60 text-right">${msg.created_at}</div>
        </div>`;
    messagesDiv.appendChild(div);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

setInterval(async () => {
    try {
        const res = await fetch(`{{ route('chat.poll', $user) }}?last_id=0`);
        const data = await res.json();


        messagesDiv.innerHTML = '';
        data.messages.forEach(addMessage);

        // Mettre à jour le statut en ligne
        onlineDot.className = `absolute bottom-0 right-0 w-3 h-3 rounded-full border-2 border-white ${data.online ? 'bg-green-400' : 'bg-gray-300'}`;
        onlineLabel.textContent = data.online ? 'En ligne' : 'Hors ligne';
        onlineLabel.className = `text-xs ${data.online ? 'text-green-500' : 'text-gray-400'}`;
    } catch (e) {}
}, 3000);
</script>
</x-app-layout>
