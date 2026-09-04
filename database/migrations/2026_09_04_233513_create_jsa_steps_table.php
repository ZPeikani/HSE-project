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
    Schema::create('jsa_steps', function (Blueprint $table) {
        $table->id();
        $table->foreignId('jsa_id')->constrained('job_safety_analyses')->cascadeOnDelete();
        $table->unsignedInteger('sort_order')->default(0);
        $table->string('step');
        $table->string('hazard')->nullable();
        $table->string('consequence')->nullable();
        $table->text('controls')->nullable();
        $table->unsignedTinyInteger('likelihood')->nullable();
        $table->unsignedTinyInteger('severity')->nullable();
        $table->unsignedInteger('risk_score')->nullable();
        $table->unsignedTinyInteger('residual_likelihood')->nullable();
        $table->unsignedTinyInteger('residual_severity')->nullable();
        $table->unsignedInteger('residual_score')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jsa_steps');
    }
};
