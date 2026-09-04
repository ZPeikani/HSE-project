<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('hse_notifications', function (Blueprint $table) {
        $table->id();
        $table->string('notification_key')->unique();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('type');
        $table->string('title');
        $table->text('message')->nullable();
        $table->string('notifiable_type');
        $table->unsignedBigInteger('notifiable_id');
        $table->timestamp('due_at')->nullable();
        $table->timestamp('read_at')->nullable();
        $table->timestamps();

        $table->index(['notifiable_type', 'notifiable_id']);
        $table->index(['user_id', 'read_at']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hse_notifications');
    }
};
