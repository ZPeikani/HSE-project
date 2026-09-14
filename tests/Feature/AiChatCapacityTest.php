<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\AiConversation;
use App\Models\AiMessage;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiChatCapacityTest extends TestCase
{
    use RefreshDatabase;

    public function test_assistant_messages_do_not_increase_user_message_capacity(): void
    {
        $this->seed(DatabaseSeeder::class);
        $user = User::where('role', UserRole::Admin->value)->firstOrFail();
        $conversation = AiConversation::create([
            'user_id' => $user->id,
            'title' => 'آزمون ظرفیت',
        ]);

        for ($index = 0; $index < 100; $index++) {
            AiMessage::insert([
                [
                    'ai_conversation_id' => $conversation->id,
                    'role' => 'user',
                    'content' => "پرسش {$index}",
                    'created_at' => now(),
                ],
                [
                    'ai_conversation_id' => $conversation->id,
                    'role' => 'assistant',
                    'content' => "پاسخ {$index}",
                    'created_at' => now(),
                ],
            ]);
        }

        $this->actingAs($user)
            ->postJson(route('ai.chat'), [
                'conversation_id' => $conversation->id,
                'message' => 'پیام ۱۰۱',
            ])
            ->assertStatus(422)
            ->assertJsonPath('conv_full', true)
            ->assertJsonPath('msg_count', 100)
            ->assertJsonPath('max_msgs', 100);

        $this->actingAs($user)
            ->getJson(route('ai.conversations.show', $conversation->id))
            ->assertOk()
            ->assertJsonPath('message_count', 100);
    }
}