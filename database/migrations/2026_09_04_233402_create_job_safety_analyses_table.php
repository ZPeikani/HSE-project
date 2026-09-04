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
    Schema::create('job_safety_analyses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('risk_id')->nullable()->constrained()->nullOnDelete();
        $table->string('activity');
        $table->string('location')->nullable();
        $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
        $table->date('review_due_at')->nullable();
        $table->string('status')->default('draft');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_safety_analyses');
    }
};
