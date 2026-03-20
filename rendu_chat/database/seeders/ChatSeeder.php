<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        // --- Utilisateurs fixes ---
        $users = [
            [
                'name'          => 'Alice Dupont',
                'email'         => 'alice@chatmew.fr',
                'password'      => Hash::make('password'),
                'last_seen_at'  => now(),
            ],
            [
                'name'          => 'Bob Martin',
                'email'         => 'bob@chatmew.fr',
                'password'      => Hash::make('password'),
                'last_seen_at'  => now()->subMinutes(2),
            ],
            [
                'name'          => 'Clara Petit',
                'email'         => 'clara@chatmew.fr',
                'password'      => Hash::make('password'),
                'last_seen_at'  => now()->subHours(1),
            ],
            [
                'name'          => 'David Moreau',
                'email'         => 'david@chatmew.fr',
                'password'      => Hash::make('password'),
                'last_seen_at'  => null,
            ],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(['email' => $data['email']], $data);
        }

        $alice = User::where('email', 'alice@chatmew.fr')->first();
        $bob   = User::where('email', 'bob@chatmew.fr')->first();
        $clara = User::where('email', 'clara@chatmew.fr')->first();
        $david = User::where('email', 'david@chatmew.fr')->first();

        // --- Conversation Alice <-> Bob ---
        $conv1 = [
            [$bob,   $alice, 'Miaou ! Salut Alice 🐱'],
            [$alice, $bob,   'Coucou Bob ! Ça va ?'],
            [$bob,   $alice, 'Super bien merci ! T\'as vu le nouveau ChatMew ?'],
            [$alice, $bob,   'Oui il est trop bien 😸 J\'adore le design !'],
            [$bob,   $alice, 'Pareil ! On peut enfin papoter comme des vrais chats 🐾'],
            [$alice, $bob,   'Haha exactement 😂'],
            [$bob,   $alice, 'Tu viens sur le salon ce soir ?'],
            [$alice, $bob,   'Oui j\'arrive vers 20h !'],
        ];

        // --- Conversation Alice <-> Clara ---
        $conv2 = [
            [$clara, $alice, 'Bonjour Alice 👋'],
            [$alice, $clara, 'Bonjour Clara !'],
            [$clara, $alice, 'Tu peux m\'aider avec le projet ?'],
            [$alice, $clara, 'Bien sûr, c\'est pour quoi ?'],
            [$clara, $alice, 'Le module de chat, je comprends pas le polling 😅'],
            [$alice, $clara, 'Pas de souci, je t\'explique ça !'],
        ];

        // --- Conversation Alice <-> David (messages non lus) ---
        $conv3 = [
            [$david, $alice, 'Salut ! Tu es là ? 🐱'],
            [$david, $alice, 'J\'ai une question urgente...'],
            [$david, $alice, 'Réponds quand tu peux !'],
        ];

        $this->createConversation($conv1, true);
        $this->createConversation($conv2, true);
        $this->createConversation($conv3, false); // Non lus pour Alice

        $this->command->info('✅ Base de données remplie avec succès !');
        $this->command->info('');
        $this->command->info('👤 Comptes disponibles (mot de passe : password) :');
        $this->command->info('   alice@chatmew.fr  — en ligne');
        $this->command->info('   bob@chatmew.fr    — en ligne');
        $this->command->info('   clara@chatmew.fr  — hors ligne');
        $this->command->info('   david@chatmew.fr  — hors ligne');
    }

    private function createConversation(array $messages, bool $markAsRead): void
    {
        $delay = 0;

        foreach ($messages as $i => [$sender, $receiver, $body]) {
            $isLast = $i === array_key_last($messages);

            Message::create([
                'sender_id'   => $sender->id,
                'receiver_id' => $receiver->id,
                'body'        => $body,
                'read_at'     => ($markAsRead && !$isLast) ? now()->subMinutes(60 - $delay) : null,
                'created_at'  => now()->subMinutes(60 - $delay),
                'updated_at'  => now()->subMinutes(60 - $delay),
            ]);

            $delay += rand(2, 8);
        }
    }
}
