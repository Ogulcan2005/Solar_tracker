<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolarMeasurementSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/zonvolgend_zonnepaneel_1week.csv');

        if (!file_exists($file)) {
            throw new \Exception("CSV-bestand niet gevonden: {$file}");
        }

        $handle = fopen($file, 'r');

        // Eerste regel bevat de kolomnamen
        $headers = fgetcsv($handle);

        $rows = [];

        while (($data = fgetcsv($handle)) !== false) {

            if (count($data) < 8) {
                continue;
            }

            $datumTijd = $data[0];
            $opbrengst = (float) $data[1];
            $positieActuator1 = (float) $data[2];
            $positieActuator2 = (float) $data[3];
            $status = $data[4];
            $verbruikActuator1 = (float) $data[5];
            $verbruikActuator2 = (float) $data[6];
            $windsnelheid = (float) $data[7];

            $motorPower =
                $verbruikActuator1 +
                $verbruikActuator2;

            $netPower =
                $opbrengst -
                $motorPower;

            $rows[] = [
                'measurement_time' => $datumTijd,

                'position' => $positieActuator1,
                'angle' => $positieActuator2,

                'power_watt' => $opbrengst,

                'energy_wh' => 0,

                'motor_power_watt' => $motorPower,
                'net_power_watt' => $netPower,

                'status' => $status,

                'actuator_1_power_watt' => $verbruikActuator1,
                'actuator_2_power_watt' => $verbruikActuator2,

                'wind_speed_kmh' => $windsnelheid,

                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Elke 500 regels naar de database schrijven
            if (count($rows) >= 500) {
                DB::table('solar_measurements')->insert($rows);
                $rows = [];
            }
        }

        // Overgebleven regels toevoegen
        if (!empty($rows)) {
            DB::table('solar_measurements')->insert($rows);
        }

        fclose($handle);
    }
}