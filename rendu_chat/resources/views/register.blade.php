<x-guest-layout>

    {{-- Header --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Créer un compte</h1>
        <p class="text-sm text-gray-500 mt-1">Rejoignez-nous en moins d'une minute</p>
    </div>

    {{-- Bande colorée --}}
    <div class="h-1.5 rounded-full mb-6" style="background: linear-gradient(90deg, #6366f1, #ec4899, #f59e0b);"></div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Prénom / Nom --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <x-input-label for="first_name" :value="__('Prénom')" class="font-semibold text-gray-700" />
                <x-text-input
                    id="first_name"
                    name="first_name"
                    type="text"
                    class="mt-1 block w-full rounded-xl border-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('first_name')"
                    placeholder="Jean"
                    required
                />
                <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="last_name" :value="__('Nom')" class="font-semibold text-gray-700" />
                <x-text-input
                    id="last_name"
                    name="last_name"
                    type="text"
                    class="mt-1 block w-full rounded-xl border-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('last_name')"
                    placeholder="Dupont"
                    required
                />
                <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
            </div>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <x-input-label for="email" :value="__('Adresse e-mail')" class="font-semibold text-gray-700" />
            <div class="mt-1 flex rounded-xl overflow-hidden border-2 focus-within:border-indigo-500">
                <span class="flex items-center px-3" style="background-color: #6366f1;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>
                    </svg>
                </span>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    placeholder="jean.dupont@exemple.fr"
                    required
                    class="flex-1 px-3 py-2 text-sm text-gray-800 border-0 focus:ring-0 outline-none"
                >
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- Mot de passe --}}
        <div class="mb-4">
            <x-input-label for="password" :value="__('Mot de passe')" class="font-semibold text-gray-700" />
            <div class="mt-1 flex rounded-xl overflow-hidden border-2 focus-within:border-pink-500">
                <span class="flex items-center px-3" style="background-color: #ec4899;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                </span>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="8 caractères minimum"
                    required
                    oninput="checkStrength(this.value)"
                    class="flex-1 px-3 py-2 text-sm text-gray-800 border-0 focus:ring-0 outline-none"
                >
                <button type="button" onclick="togglePassword('password', this)" class="px-3 text-gray-400 hover:text-indigo-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                </button>
            </div>
            {{-- Indicateur de force --}}
            <div id="strength-wrapper" class="mt-2 hidden">
                <div class="w-full h-1.5 bg-gray-200 rounded-full overflow-hidden">
                    <div id="strength-bar" class="h-full rounded-full transition-all duration-300" style="width: 0%;"></div>
                </div>
                <p id="strength-label" class="text-xs font-semibold mt-1"></p>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- Confirmation mot de passe --}}
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="font-semibold text-gray-700" />
            <div class="mt-1 flex rounded-xl overflow-hidden border-2 focus-within:border-amber-500">
                <span class="flex items-center px-3" style="background-color: #f59e0b;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                </span>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Répétez le mot de passe"
                    required
                    class="flex-1 px-3 py-2 text-sm text-gray-800 border-0 focus:ring-0 outline-none"
                >
                <button type="button" onclick="togglePassword('password_confirmation', this)" class="px-3 text-gray-400 hover:text-amber-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Séparateur --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="flex-1 h-px" style="background: linear-gradient(90deg, #6366f1, #ec4899);"></div>
            <span class="text-xs font-semibold text-gray-400 whitespace-nowrap">infos complémentaires</span>
            <div class="flex-1 h-px" style="background: linear-gradient(90deg, #ec4899, #f59e0b);"></div>
        </div>

        {{-- Téléphone / Date de naissance --}}
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <x-input-label for="phone" class="font-semibold text-gray-700">
                    Téléphone <span class="font-normal text-gray-400">(optionnel)</span>
                </x-input-label>
                <x-text-input
                    id="phone"
                    name="phone"
                    type="tel"
                    class="mt-1 block w-full rounded-xl border-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('phone')"
                    placeholder="+33 6 00 00 00 00"
                />
                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="birth_date" class="font-semibold text-gray-700">
                    Date de naissance <span class="font-normal text-gray-400">(optionnel)</span>
                </x-input-label>
                <x-text-input
                    id="birth_date"
                    name="birth_date"
                    type="date"
                    class="mt-1 block w-full rounded-xl border-2 focus:border-indigo-500 focus:ring-indigo-500"
                    :value="old('birth_date')"
                />
                <x-input-error :messages="$errors->get('birth_date')" class="mt-1" />
            </div>
        </div>

        {{-- CGU --}}
        <div class="mb-6 p-3 rounded-xl border border-indigo-100 bg-gradient-to-r from-indigo-50 to-pink-50">
            <label class="flex items-start gap-3 cursor-pointer">
                <input
                    type="checkbox"
                    name="terms"
                    id="terms"
                    value="1"
                    {{ old('terms') ? 'checked' : '' }}
                    class="mt-0.5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                >
                <span class="text-sm text-gray-600">
                    J'accepte les <a href="{{ route('terms') }}" class="font-semibold text-indigo-600 hover:underline">conditions d'utilisation</a>
                    et la <a href="{{ route('privacy') }}" class="font-semibold text-pink-500 hover:underline">politique de confidentialité</a>
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-1" />
        </div>

        {{-- Bouton --}}
        <button
            type="submit"
            class="w-full py-2.5 text-white font-bold rounded-xl transition hover:opacity-90 active:scale-95"
            style="background: linear-gradient(90deg, #6366f1, #ec4899);"
        >
            Créer mon compte →
        </button>

        <p class="text-center text-sm text-gray-500 mt-4">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline">Se connecter</a>
        </p>

    </form>

    <script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function checkStrength(value) {
        const wrapper = document.getElementById('strength-wrapper');
        const bar = document.getElementById('strength-bar');
        const label = document.getElementById('strength-label');

        if (!value) { wrapper.classList.add('hidden'); return; }
        wrapper.classList.remove('hidden');

        let score = 0;
        if (value.length >= 8) score++;
        if (/[A-Z]/.test(value)) score++;
        if (/[0-9]/.test(value)) score++;
        if (/[^A-Za-z0-9]/.test(value)) score++;

        const levels = [
            { width: '20%', color: '#ef4444', label: 'Très faible' },
            { width: '40%', color: '#f59e0b', label: 'Faible' },
            { width: '65%', color: '#f59e0b', label: 'Moyen' },
            { width: '85%', color: '#10b981', label: 'Fort' },
            { width: '100%', color: '#10b981', label: 'Très fort' },
        ];

        const level = levels[Math.min(score, 4)];
        bar.style.width = level.width;
        bar.style.backgroundColor = level.color;
        label.textContent = level.label;
        label.style.color = level.color;
    }
    </script>

</x-guest-layout>