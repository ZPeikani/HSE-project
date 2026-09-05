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
    Schema::create('safety_equipments', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('code')->nullable()->unique();
        $table->string('type')->nullable();
        $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
        $table->string('status')->default('active');
        $table->date('next_inspection_at')->nullable();
        $table->date('next_service_at')->nullable();
        $table->date('expiry_date')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_equipments');
    }
};
