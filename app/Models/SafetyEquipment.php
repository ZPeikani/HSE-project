<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SafetyEquipment extends Model
{
    protected $table = 'safety_equipments';

    protected $fillable = [
        'code',
        'name',
        'type',
        'department_id',
        'location',
        'serial_number',
        'inspection_interval_days',
        'service_interval_days',
        'last_inspected_at',
        'next_inspection_at',
        'last_serviced_at',
        'next_service_at',
        'expiry_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'last_inspected_at' => 'date',
            'next_inspection_at' => 'date',
            'last_serviced_at' => 'date',
            'next_service_at' => 'date',
            'expiry_date' => 'date',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}