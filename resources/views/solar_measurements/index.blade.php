<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar Tracker</title>
</head>
<body>

<h1>Solar Tracker</h1>

@php
    $latest = $measurements->first();
@endphp

@if ($latest)

    <h2>Laatste meting</h2>
    <p>Positie: {{ $latest->position }}°</p>
    <p>Hoek: {{ $latest->angle }}°</p>
    <p>Opbrengst: {{ $latest->power_watt }} W</p>
    <p>Energie: {{ $latest->energy_wh }} Wh</p>
    <p>Motorverbruik: {{ $latest->motor_power_watt }} W</p>
    <p>Netto: {{ $latest->net_power_watt }} W</p>

    <h2>Alle metingen</h2>
    <ul>
        @foreach ($measurements as $measurement)
        <li>
            {{ \Carbon\Carbon::parse($measurement->measurement_time)->format('d-m-Y H:i') }}
            —
            positie {{ $measurement->position }}°,
            hoek {{ $measurement->angle }}°,
            opbrengst {{ $measurement->power_watt }} W,
            energie {{ $measurement->energy_wh }} Wh,
            motor {{ $measurement->motor_power_watt }} W,
            netto {{ $measurement->net_power_watt }} W,
            actuator 1 {{ $measurement->actuator_1_power_watt }} W,
            actuator 2 {{ $measurement->actuator_2_power_watt }} W,
            wind {{ $measurement->wind_speed_kmh }} km/u,
            status {{ $measurement->status }}
        </li>
        @endforeach
    </ul>

@else

    <p>Er zijn nog geen metingen.</p>

@endif

</body>
</html>
