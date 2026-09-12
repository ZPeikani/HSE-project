<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('safety_equipments')
            ->whereNull('recharge_interval_days')
            ->update(['recharge_interval_days' => DB::raw('COALESCE(service_interval_days, 365)')]);

        DB::table('safety_equipments')
            ->whereNotNull('last_recharged_at')
            ->whereNotNull('recharge_interval_days')
            ->get(['id', 'last_recharged_at', 'recharge_interval_days'])
            ->each(function (object $equipment): void {
                DB::table('safety_equipments')
                    ->where('id', $equipment->id)
                    ->update([
                        'next_recharge_at' => date(
                            'Y-m-d',
                            strtotime("{$equipment->last_recharged_at} + {$equipment->recharge_interval_days} days")
                        ),
                    ]);
            });
    }

    public function down(): void
    {
        // Existing equipment data should not be erased on rollback.
    }
};
