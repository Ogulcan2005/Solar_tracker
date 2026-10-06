<h2>Alle metingen</h2>

<div style="overflow-x: auto;">
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Datum / tijd</th>
                <th>Positie actuator 1</th>
                <th>Positie actuator 2</th>
                <th>Opbrengst</th>
                <th>Status</th>
                <th>Verbruik actuator 1</th>
                <th>Verbruik actuator 2</th>
                <th>Motor verbruik</th>
                <th>Netto opbrengst</th>
                <th>Windsnelheid</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($measurements as $measurement)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($measurement->measurement_time)->format('d-m-Y H:i:s') }}
                    </td>

                    <td>
                        {{ $measurement->position }}°
                    </td>

                    <td>
                        {{ $measurement->angle }}°
                    </td>

                    <td>
                        {{ $measurement->power_watt }} W
                    </td>

                    <td>
                        {{ $measurement->status }}
                    </td>

                    <td>
                        {{ $measurement->actuator_1_power_watt }} W
                    </td>

                    <td>
                        {{ $measurement->actuator_2_power_watt }} W
                    </td>

                    <td>
                        {{ $measurement->motor_power_watt }} W
                    </td>

                    <td>
                        {{ $measurement->net_power_watt }} W
                    </td>

                    <td>
                        {{ $measurement->wind_speed_kmh }} km/u
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>