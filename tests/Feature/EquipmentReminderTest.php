<?php

namespace Tests\Feature;

use App\Models\{Department, HseNotification, SafetyEquipment, User};
use App\Services\HseReminderService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Morilog\Jalali\Jalalian;
use Tests\TestCase;

class EquipmentReminderTest extends TestCase
{
    use RefreshDatabase;

    public function test_equipment_due_dates_create_reminders(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@hse.test')->firstOrFail();

        $equipment = SafetyEquipment::create([
            'code' => 'EQ-001',
            'name' => 'کپسول سالن تولید',
            'type' => 'fire_extinguisher',
            'department_id' => $admin->department_id,
            'location' => 'سالن تولید',
            'status' => 'active',
            'next_inspection_at' => today()->addDays(3),
            'next_service_at' => today()->addDays(30),
            'expiry_date' => today()->addDays(3),
        ]);

        app(HseReminderService::class)->syncFor($admin);

        $this->assertDatabaseHas('hse_notifications', [
            'user_id' => $admin->id,
            'notifiable_type' => SafetyEquipment::class,
            'notifiable_id' => $equipment->id,
            'notification_key' => "equipment:{$equipment->id}:{$admin->id}",
        ]);
        $this->assertDatabaseCount('hse_notifications', 2);
    }

    public function test_unit_manager_only_receives_reminders_for_own_department(): void
    {
        $this->seed(DatabaseSeeder::class);
        $unitManager = User::where('email', 'unit@hse.test')->firstOrFail();
        $otherDepartment = Department::where('code', 'MNT')->firstOrFail();

        SafetyEquipment::create([
            'code' => 'EQ-OWN',
            'name' => 'تجهیز تولید',
            'type' => 'detector',
            'department_id' => $unitManager->department_id,
            'location' => 'تولید',
            'status' => 'active',
            'next_inspection_at' => today()->addDay(),
        ]);
        SafetyEquipment::create([
            'code' => 'EQ-OTHER',
            'name' => 'تجهیز تعمیرات',
            'type' => 'detector',
            'department_id' => $otherDepartment->id,
            'location' => 'تعمیرات',
            'status' => 'active',
            'next_inspection_at' => today()->addDay(),
        ]);

        app(HseReminderService::class)->syncFor($unitManager);

        $this->assertDatabaseHas('hse_notifications', ['user_id' => $unitManager->id, 'message' => 'EQ-OWN — تجهیز تولید']);
        $this->assertDatabaseMissing('hse_notifications', ['user_id' => $unitManager->id, 'message' => 'EQ-OTHER — تجهیز تعمیرات']);
    }

    public function test_equipment_form_accepts_jalali_dates(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@hse.test')->firstOrFail();
        $lastInspection = Jalalian::now()->subDays(3);
        $expiry = Jalalian::now()->addDays(30);

        $this->actingAs($admin)->post(route('equipment.store'), [
            'code' => 'EQ-JALALI-001',
            'name' => 'تجهیز با تاریخ جلالی',
            'type' => 'detector',
            'department_id' => 1,
            'location' => 'سالن تولید',
            'inspection_interval_days' => 30,
            'service_interval_days' => 365,
            'last_inspected_at' => $lastInspection->format('Y/m/d'),
            'expiry_date' => $expiry->format('Y/m/d'),
        ])->assertRedirect();

        $equipment = SafetyEquipment::where('code', 'EQ-JALALI-001')->firstOrFail();
        $this->assertSame($lastInspection->toCarbon()->toDateString(), $equipment->last_inspected_at->toDateString());
        $this->assertSame($expiry->toCarbon()->toDateString(), $equipment->expiry_date->toDateString());
        $this->assertSame($lastInspection->toCarbon()->addDays(30)->toDateString(), $equipment->next_inspection_at->toDateString());
    }

    public function test_equipment_operations_update_their_own_dates(): void
    {
        $this->seed(DatabaseSeeder::class);
        $admin = User::where('email', 'admin@hse.test')->firstOrFail();
        $equipment = SafetyEquipment::create([
            'code' => 'EQ-OPS-001',
            'name' => 'تجهیز عملیاتی',
            'type' => 'fire_extinguisher',
            'department_id' => $admin->department_id,
            'location' => 'سالن تولید',
            'status' => 'active',
            'inspection_interval_days' => 30,
            'service_interval_days' => 90,
            'recharge_interval_days' => 180,
        ]);

        foreach (['inspection', 'service', 'recharge'] as $operation) {
            $this->actingAs($admin)->post(route('equipment.inspect', $equipment), [
                'operation' => $operation,
                'date' => '2026-09-12',
            ])->assertRedirect();
        }

        $equipment->refresh();
        $this->assertSame('2026-09-12', $equipment->last_inspected_at->toDateString());
        $this->assertSame('2026-10-12', $equipment->next_inspection_at->toDateString());
        $this->assertSame('2026-09-12', $equipment->last_serviced_at->toDateString());
        $this->assertSame('2026-12-11', $equipment->next_service_at->toDateString());
        $this->assertSame('2026-09-12', $equipment->last_recharged_at->toDateString());
        $this->assertSame('2027-03-11', $equipment->next_recharge_at->toDateString());
    }
}
