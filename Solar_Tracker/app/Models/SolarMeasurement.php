<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarMeasurement extends Model
{
    protected $casts = [
        'measurement_time' => 'datetime',
        'position' => 'float',
        'angle' => 'float',
        'power_watt' => 'float',
        'energy_wh' => 'float',
        'motor_power_watt' => 'float',
        'net_power_watt' => 'float',
        'actuator_1_power_watt' => 'float',
        'actuator_2_power_watt' => 'float',
        'wind_speed_kmh' => 'float',
    ];

    protected $fillable = [
        'position',
        'angle',
        'power_watt',
        'energy_wh',
        'motor_power_watt',
        'net_power_watt',
    ];
}