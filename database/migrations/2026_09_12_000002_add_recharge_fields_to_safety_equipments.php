<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = [
            'recharge_interval_days' => fn (Blueprint $table) => $table->unsignedInteger('recharge_interval_days')->nullable(),
            'last_recharged_at' => fn (Blueprint $table) => $table->date('last_recharged_at')->nullable(),
            'next_recharge_at' => fn (Blueprint $table) => $table->date('next_recharge_at')->nullable(),
        ];

        foreach ($columns as $column => $definition) {
            if (! Schema::hasColumn('safety_equipments', $column)) {
                Schema::table('safety_equipments', $definition);
            }
        }
    }

    public function down(): void
    {
        foreach (['recharge_interval_days', 'last_recharged_at', 'next_recharge_at'] as $column) {
            if (Schema::hasColumn('safety_equipments', $column)) {
                Schema::table('safety_equipments', fn (Blueprint $table) => $table->dropColumn($column));
            }
        }
    }
};
