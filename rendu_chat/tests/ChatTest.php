<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------
    // Tests d'accès
    // -------------------------------------------------------

    public function test_guest_cannot_access_chat(): void
    {
        $this->get(route('chat.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_chat(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('chat.index'))
            ->assertOk();
    }

    // -------------------------------------------------------
    // Envoi de messages
    // -------------------------------------------------------

    public function test_user_can_send_a_message(): void
    {
        [$sender, $receiver] = User::factory()->count(2)->create();

        $this->actingAs($sender)
            ->post(route('chat.store', $receiver), ['body' => 'Miaou !'])
            ->assertRedirect(route('chat.show', $receiver));

        $this->assertDatabaseHas('messages', [
            'sender_id'   => $sender->id,
            'receiver_id' => $receiver->id,
            'body'        => 'Miaou !',
        ]);
    }

    public function test_user_cannot_send_empty_message(): void
    {
        [$sender, $receiver] = User::factory()->count(2)->create();

        $this->actingAs($sender)
            ->post(route('chat.store', $receiver), ['body' => ''])
            ->assertSessionHasErrors('body');

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_user_cannot_send_message_too_long(): void
    {
        [$sender, $receiver] = User::factory()->count(2)->create();

        $this->actingAs($sender)
            ->post(route('chat.store', $receiver), ['body' => str_repeat('a', 1001)])
            ->assertSessionHasErrors('body');
    }

    public function test_guest_cannot_send_message(): void
    {
        $receiver = User::factory()->create();

        $this->post(route('chat.store', $receiver), ['body' => 'Miaou !'])
            ->assertRedirect(route('login'));

        $this->assertDatabaseCount('messages', 0);
    }

    // -------------------------------------------------------
    // Affichage de conversation
    // -------------------------------------------------------

    public function test_user_can_view_conversation(): void
    {
        [$userA, $userB] = User::factory()->count(2)->create();

        Message::create([
            'sender_id'   => $userA->id,
            'receiver_id' => $userB->id,
            'body'        => 'Bonjour !',
        ]);

        $this->actingAs($userA)
            ->get(route('chat.show', $userB))
            ->assertOk()
            ->assertSee('Bonjour !');
    }

    public function test_user_cannot_see_messages_from_other_conversations(): void
    {
        [$userA, $userB, $userC] = User::factory()->count(3)->create();

        Message::create([
            'sender_id'   => $userB->id,
            'receiver_id' => $userC->id,
            'body'        => 'Message secret',
        ]);

        $this->actingAs($userA)
            ->get(route('chat.show', $userB))
            ->assertOk()
            ->assertDontSee('Message secret');
    }

    // -------------------------------------------------------
    // Lu / Non lu
    // -------------------------------------------------------

    public function test_messages_are_marked_as_read_when_conversation_is_opened(): void
    {
        [$sender, $receiver] = User::factory()->count(2)->create();

        $message = Message::create([
            'sender_id'   => $sender->id,
            'receiver_id' => $receiver->id,
            'body'        => 'Coucou',
            'read_at'     => null,
        ]);

        $this->assertNull($message->read_at);

        $this->actingAs($receiver)
            ->get(route('chat.show', $sender));

        $this->assertNotNull($message->fresh()->read_at);
    }

    public function test_unread_count_is_correct(): void
    {
        [$sender, $receiver] = User::factory()->count(2)->create();

        Message::factory()->count(3)->create([
            'sender_id'   => $sender->id,
            'receiver_id' => $receiver->id,
            'read_at'     => null,
        ]);

        $unread = Message::where('sender_id', $sender->id)
            ->where('receiver_id', $receiver->id)
            ->whereNull('read_at')
            ->count();

        $this->assertEquals(3, $unread);
    }

    // -------------------------------------------------------
    // Statut en ligne
    // -------------------------------------------------------

    public function test_user_is_online_after_activity(): void
    {
        $user = User::factory()->create(['last_seen_at' => now()]);

        $this->assertTrue($user->isOnline());
    }

    public function test_user_is_offline_after_inactivity(): void
    {
        $user = User::factory()->create(['last_seen_at' => now()->subMinutes(10)]);

        $this->assertFalse($user->isOnline());
    }

    public function test_last_seen_is_updated_on_chat_access(): void
    {
        $user = User::factory()->create(['last_seen_at' => null]);

        $this->actingAs($user)->get(route('chat.index'));

        $this->assertNotNull($user->fresh()->last_seen_at);
    }

    // -------------------------------------------------------
    // Polling AJAX
    // -------------------------------------------------------

    public function test_poll_returns_new_messages_as_json(): void
    {
        [$userA, $userB] = User::factory()->count(2)->create();

        $msg = Message::create([
            'sender_id'   => $userB->id,
            'receiver_id' => $userA->id,
            'body'        => 'Nouveau message',
        ]);

        $this->actingAs($userA)
            ->getJson(route('chat.poll', $userB) . '?last_id=0')
            ->assertOk()
            ->assertJsonCount(1, 'messages')
            ->assertJsonPath('messages.0.body', 'Nouveau message');
    }

    public function test_poll_returns_only_messages_after_last_id(): void
    {
        [$userA, $userB] = User::factory()->count(2)->create();

        $first = Message::create([
            'sender_id'   => $userA->id,
            'receiver_id' => $userB->id,
            'body'        => 'Premier',
        ]);

        Message::create([
            'sender_id'   => $userB->id,
            'receiver_id' => $userA->id,
            'body'        => 'Deuxième',
        ]);

        $this->actingAs($userA)
            ->getJson(route('chat.poll', $userB) . "?last_id={$first->id}")
            ->assertOk()
            ->assertJsonCount(1, 'messages')
            ->assertJsonPath('messages.0.body', 'Deuxième');
    }
}
