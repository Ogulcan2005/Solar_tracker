<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolarMeasurementSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'measurement_time' => '2026-06-01 06:00:00',
                'position' => 0.3,
                'angle' => 0.2,
                'power_watt' => 2.8,
                'energy_wh' => 0.0,
                'motor_power_watt' => 75.8,
                'net_power_watt' => -73.0,
                'status' => 'Aan',
                'actuator_1_power_watt' => 32.3,
                'actuator_2_power_watt' => 43.5,
                'wind_speed_kmh' => 11.4,
            ],

            [
                'measurement_time' => '2026-06-01 08:00:00',
                'position' => 13.5,
                'angle' => 40.6,
                'power_watt' => 167.3,
                'energy_wh' => 0.0,
                'motor_power_watt' => 50.9,
                'net_power_watt' => 116.4,
                'status' => 'Aan',
                'actuator_1_power_watt' => 33.4,
                'actuator_2_power_watt' => 17.5,
                'wind_speed_kmh' => 21.5,
            ],

            [
                'measurement_time' => '2026-06-01 10:00:00',
                'position' => 27.0,
                'angle' => 74.4,
                'power_watt' => 349.3,
                'energy_wh' => 0.0,
                'motor_power_watt' => 66.9,
                'net_power_watt' => 282.4,
                'status' => 'Aan',
                'actuator_1_power_watt' => 30.6,
                'actuator_2_power_watt' => 36.3,
                'wind_speed_kmh' => 13.3,
            ],

            [
                'measurement_time' => '2026-06-01 12:00:00',
                'position' => 40.2,
                'angle' => 95.2,
                'power_watt' => 449.5,
                'energy_wh' => 0.0,
                'motor_power_watt' => 60.0,
                'net_power_watt' => 389.5,
                'status' => 'Aan',
                'actuator_1_power_watt' => 16.6,
                'actuator_2_power_watt' => 43.4,
                'wind_speed_kmh' => 6.2,
            ],

            [
                'measurement_time' => '2026-06-01 14:00:00',
                'position' => 53.1,
                'angle' => 99.7,
                'power_watt' => 449.6,
                'energy_wh' => 0.0,
                'motor_power_watt' => 61.8,
                'net_power_watt' => 387.8,
                'status' => 'Aan',
                'actuator_1_power_watt' => 36.6,
                'actuator_2_power_watt' => 25.2,
                'wind_speed_kmh' => 5.5,
            ],
        ];

        DB::table('solar_measurements')->insert($data);
    }
}