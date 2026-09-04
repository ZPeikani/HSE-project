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
    Schema::create('work_permits', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->string('title');
        $table->string('type')->nullable();
        $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('requester_id')->nullable()->constrained('users')->nullOnDelete();
        $table->foreignId('approver_id')->nullable()->constrained('users')->nullOnDelete();
        $table->string('location')->nullable();
        $table->text('description')->nullable();
        $table->text('hazards')->nullable();
        $table->text('controls')->nullable();
        $table->dateTime('starts_at')->nullable();
        $table->dateTime('ends_at')->nullable();
        $table->string('status')->default('pending');
        $table->dateTime('closed_at')->nullable();
        $table->text('closure_notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_permits');
    }
};
