<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarMeasurement extends Model
{
    protected $fillable = [
        'position',
        'angle',
        'power_watt',
        'energy_wh',
        'motor_power_watt',
        'net_power_watt',
    ];
}