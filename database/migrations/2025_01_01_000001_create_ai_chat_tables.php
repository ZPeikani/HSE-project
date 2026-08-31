<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ai_conversations', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->string('title')->nullable();
            $t->timestamps();
            $t->index(['user_id', 'created_at']);
        });

        Schema::create('ai_messages', function (Blueprint $t) {
            $t->id();
            $t->foreignId('ai_conversation_id')->constrained()->cascadeOnDelete();
            $t->enum('role', ['user', 'assistant']);
            $t->text('content');
            $t->timestamp('created_at')->useCurrent();
            $t->index('ai_conversation_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_messages');
        Schema::dropIfExists('ai_conversations');
    }
};
