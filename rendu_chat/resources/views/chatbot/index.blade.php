<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ChatBot IA – {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@400;600;700;800&display=swap');

        :root {
            --bg:       #0d0d0f;
            --surface:  #16161a;
            --border:   #2a2a35;
            --accent:   #7c6ef5;
            --accent2:  #e06be0;
            --text:     #e8e8f0;
            --muted:    #6b6b80;
            --user-bg:  #1e1b3a;
            --bot-bg:   #191924;
            --radius:   14px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Syne', sans-serif;
            background: var(--bg);
            color: var(--text);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* ── Header ── */
        header {
            padding: 18px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            flex-shrink: 0;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }
        .logo h1 { font-size: 1.1rem; font-weight: 700; letter-spacing: -0.02em; }
        .logo span { font-size: .75rem; color: var(--muted); font-weight: 400; margin-left: 2px; }

        #btn-clear {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 6px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-family: inherit;
            font-size: .8rem;
            transition: all .2s;
        }
        #btn-clear:hover { border-color: var(--accent2); color: var(--accent2); }

        /* ── Chat area ── */
        #chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 24px 0;
            scroll-behavior: smooth;
        }
        #chat-container::-webkit-scrollbar { width: 4px; }
        #chat-container::-webkit-scrollbar-track { background: transparent; }
        #chat-container::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

        .message-wrapper {
            display: flex;
            padding: 6px 24px;
            max-width: 860px;
            margin: 0 auto;
            width: 100%;
            gap: 12px;
            animation: fadeUp .3s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .message-wrapper.user  { flex-direction: row-reverse; }
        .message-wrapper.bot   { flex-direction: row; }

        .avatar {
            width: 34px; height: 34px;
            border-radius: 10px;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            margin-top: 2px;
        }
        .avatar.user { background: var(--user-bg); border: 1px solid var(--accent); }
        .avatar.bot  { background: linear-gradient(135deg, var(--accent), var(--accent2)); }

        .bubble {
            padding: 12px 16px;
            border-radius: var(--radius);
            font-size: .93rem;
            line-height: 1.6;
            max-width: 72%;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
        .message-wrapper.user .bubble {
            background: var(--user-bg);
            border: 1px solid rgba(124,110,245,.3);
            border-bottom-right-radius: 4px;
            color: #d4d0ff;
        }
        .message-wrapper.bot .bubble {
            background: var(--bot-bg);
            border: 1px solid var(--border);
            border-bottom-left-radius: 4px;
        }

        /* Model badge */
        .model-tag {
            font-family: 'DM Mono', monospace;
            font-size: .65rem;
            color: var(--muted);
            margin-top: 5px;
            padding-left: 2px;
        }

        /* Empty state */
        #empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 14px;
            color: var(--muted);
        }
        #empty-state .big-icon { font-size: 3rem; }
        #empty-state p { font-size: .95rem; }

        /* Loading dots */
        .typing-dots span {
            display: inline-block;
            width: 6px; height: 6px;
            margin: 0 2px;
            background: var(--accent);
            border-radius: 50%;
            animation: bounce 1.2s infinite;
        }
        .typing-dots span:nth-child(2) { animation-delay: .2s; }
        .typing-dots span:nth-child(3) { animation-delay: .4s; }
        @keyframes bounce {
            0%, 80%, 100% { transform: translateY(0); opacity: .5; }
            40%            { transform: translateY(-6px); opacity: 1; }
        }

        /* Error bubble */
        .bubble.error { background: #2d1515; border-color: #7f2020; color: #f87070; }

        /* ── Input bar ── */
        #input-bar {
            padding: 16px 24px 20px;
            border-top: 1px solid var(--border);
            background: var(--surface);
            flex-shrink: 0;
        }
        .input-inner {
            max-width: 860px;
            margin: 0 auto;
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }
        #user-input {
            flex: 1;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 12px;
            padding: 12px 16px;
            font-family: inherit;
            font-size: .93rem;
            resize: none;
            min-height: 48px;
            max-height: 180px;
            line-height: 1.5;
            outline: none;
            transition: border-color .2s;
            overflow-y: auto;
        }
        #user-input::placeholder { color: var(--muted); }
        #user-input:focus { border-color: var(--accent); }

        #send-btn {
            width: 48px; height: 48px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            transition: opacity .2s, transform .1s;
        }
        #send-btn:hover  { opacity: .85; }
        #send-btn:active { transform: scale(.95); }
        #send-btn:disabled { opacity: .4; cursor: default; }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <div class="logo">
        <div class="logo-icon">✦</div>
        <div>
            <h1>ChatBot IA <span>/ OpenRouter</span></h1>
        </div>
    </div>
    <button id="btn-clear">↺ Réinitialiser</button>
</header>

<!-- Messages -->
<div id="chat-container">
    <div id="empty-state">
        <div class="big-icon">✦</div>
        <p>Commence une conversation ci-dessous.</p>
    </div>
</div>

<!-- Input -->
<div id="input-bar">
    <div class="input-inner">
        <textarea
            id="user-input"
            placeholder="Envoie un message… (Entrée pour envoyer)"
            rows="1"
        ></textarea>
        <button id="send-btn" title="Envoyer">➤</button>
    </div>
</div>

<script>
    const chatContainer = document.getElementById('chat-container');
    const emptyState    = document.getElementById('empty-state');
    const userInput     = document.getElementById('user-input');
    const sendBtn       = document.getElementById('send-btn');
    const clearBtn      = document.getElementById('btn-clear');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    /* ── Auto-resize textarea ── */
    userInput.addEventListener('input', () => {
        userInput.style.height = 'auto';
        userInput.style.height = Math.min(userInput.scrollHeight, 180) + 'px';
    });

    /* ── Send on Enter (Shift+Enter = newline) ── */
    userInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    sendBtn.addEventListener('click', sendMessage);
    clearBtn.addEventListener('click', clearHistory);

    function appendMessage(role, content, model = null) {
        emptyState.style.display = 'none';

        const wrapper = document.createElement('div');
        wrapper.className = `message-wrapper ${role}`;

        const avatar = document.createElement('div');
        avatar.className = `avatar ${role}`;
        avatar.textContent = role === 'user' ? '🧑' : '✦';

        const right = document.createElement('div');

        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        bubble.textContent = content;
        right.appendChild(bubble);

        if (model && role === 'bot') {
            const tag = document.createElement('div');
            tag.className = 'model-tag';
            tag.textContent = model;
            right.appendChild(tag);
        }

        wrapper.appendChild(avatar);
        wrapper.appendChild(right);
        chatContainer.appendChild(wrapper);
        chatContainer.scrollTop = chatContainer.scrollHeight;

        return bubble;
    }

    function appendTyping() {
        emptyState.style.display = 'none';
        const wrapper = document.createElement('div');
        wrapper.className = 'message-wrapper bot';
        wrapper.id = 'typing-indicator';

        const avatar = document.createElement('div');
        avatar.className = 'avatar bot';
        avatar.textContent = '✦';

        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        bubble.innerHTML = '<div class="typing-dots"><span></span><span></span><span></span></div>';

        wrapper.appendChild(avatar);
        wrapper.appendChild(bubble);
        chatContainer.appendChild(wrapper);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    function removeTyping() {
        const el = document.getElementById('typing-indicator');
        if (el) el.remove();
    }

    async function sendMessage() {
        const text = userInput.value.trim();
        if (!text) return;

        userInput.value = '';
        userInput.style.height = 'auto';
        sendBtn.disabled = true;

        appendMessage('user', text);
        appendTyping();

        try {
            const res = await fetch('{{ route("chatbot.send") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ message: text }),
            });

            removeTyping();
            const data = await res.json();

            if (data.error) {
                appendMessage('bot', '⚠ ' + data.error).classList.add('error');
            } else {
                appendMessage('bot', data.message, data.model);
            }
        } catch (err) {
            removeTyping();
            appendMessage('bot', '⚠ Erreur réseau : ' + err.message).classList.add('error');
        } finally {
            sendBtn.disabled = false;
            userInput.focus();
        }
    }

    async function clearHistory() {
        await fetch('{{ route("chatbot.clear") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
        });
        chatContainer.innerHTML = '';
        chatContainer.appendChild(emptyState);
        emptyState.style.display = 'flex';
    }
</script>
</body>
</html>
