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
        Schema::create('solar_measurements', function (Blueprint $table) {
            $table->id();

            $table->dateTime('measurement_time');

            $table->decimal('position', 5, 2);
            $table->decimal('angle', 5, 2);

            $table->decimal('power_watt', 10, 2);
            $table->decimal('energy_wh', 10, 2);

            $table->decimal('motor_power_watt', 10, 2);
            $table->decimal('net_power_watt', 10, 2);

            $table->string('status');
            $table->decimal('actuator_1_power_watt', 10, 2);
            $table->decimal('actuator_2_power_watt', 10, 2);
            $table->decimal('wind_speed_kmh', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_measurements');
    }
};