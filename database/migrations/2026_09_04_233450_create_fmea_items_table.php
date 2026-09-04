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
    Schema::create('fmea_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fmea_id')->constrained('fmea_analyses')->cascadeOnDelete();
        $table->unsignedInteger('sort_order')->default(0);
        $table->string('failure_mode');
        $table->string('effect')->nullable();
        $table->string('cause')->nullable();
        $table->string('existing_control')->nullable();
        $table->unsignedTinyInteger('severity')->default(1);
        $table->unsignedTinyInteger('occurrence')->default(1);
        $table->unsignedTinyInteger('detection')->default(1);
        $table->unsignedInteger('rpn')->default(0);
        $table->text('recommended_action')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fmea_items');
    }
};
