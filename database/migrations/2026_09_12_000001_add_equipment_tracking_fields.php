<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $columns = [
            'location' => fn (Blueprint $table) => $table->string('location')->nullable(),
            'serial_number' => fn (Blueprint $table) => $table->string('serial_number')->nullable(),
            'inspection_interval_days' => fn (Blueprint $table) => $table->unsignedInteger('inspection_interval_days')->nullable(),
            'service_interval_days' => fn (Blueprint $table) => $table->unsignedInteger('service_interval_days')->nullable(),
            'recharge_interval_days' => fn (Blueprint $table) => $table->unsignedInteger('recharge_interval_days')->nullable(),
            'last_inspected_at' => fn (Blueprint $table) => $table->date('last_inspected_at')->nullable(),
            'last_serviced_at' => fn (Blueprint $table) => $table->date('last_serviced_at')->nullable(),
            'last_recharged_at' => fn (Blueprint $table) => $table->date('last_recharged_at')->nullable(),
            'next_recharge_at' => fn (Blueprint $table) => $table->date('next_recharge_at')->nullable(),
            'notes' => fn (Blueprint $table) => $table->text('notes')->nullable(),
        ];

        foreach ($columns as $column => $definition) {
            if (!Schema::hasColumn('safety_equipments', $column)) {
                Schema::table('safety_equipments', $definition);
            }
        }
    }

    public function down(): void
    {
        $columns = [
            'location',
            'serial_number',
            'inspection_interval_days',
            'service_interval_days',
            'recharge_interval_days',
            'last_inspected_at',
            'last_serviced_at',
            'last_recharged_at',
            'next_recharge_at',
            'notes',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('safety_equipments', $column)) {
                Schema::table('safety_equipments', fn (Blueprint $table) => $table->dropColumn($column));
            }
        }
    }
};
