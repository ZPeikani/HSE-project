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
    Schema::create('ppe_issues', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('ppe_type_id')->constrained('ppe_types')->cascadeOnDelete();
        $table->unsignedInteger('quantity')->default(1);
        $table->date('issued_at')->nullable();
        $table->date('expires_at')->nullable();
        $table->date('returned_at')->nullable();
        $table->string('condition')->nullable();
        $table->string('status')->default('issued');
        $table->foreignId('issued_by')->nullable()->constrained('users')->nullOnDelete();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppe_issues');
    }
};
