<?php

namespace App\Http\Controllers;

use App\Models\SolarMeasurement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'live' => $this->liveSnapshot(),
            'history' => $this->historySeries(),
            'log' => $this->measurementLog(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function liveSnapshot(): array
    {
        $latest = SolarMeasurement::query()
            ->latest('measurement_time')
            ->first();

        if ($latest === null) {
            throw new \RuntimeException('Geen CSV-metingen gevonden. Voer eerst de SolarMeasurementSeeder uit.');
        }

        $day = Carbon::parse($latest->measurement_time)->toDateString();
        $measurements = $this->measurementsForDay($day);
        $yieldWh = $this->energyWh($measurements, 'power_watt');
        $motorWh = $this->energyWh($measurements, 'motor_power_watt');

        return [
            'status' => $this->statusKey($latest->status),
            'status_label' => $latest->status,
            'updated_at' => Carbon::parse($latest->measurement_time)->format('d-m-Y H:i:s'),
            'position_deg' => (float) $latest->position,
            'target_deg' => null,
            'yield' => [
                'w' => (float) $latest->power_watt,
                'wh_today' => $yieldWh,
                'kwh_today' => $yieldWh / 1000,
            ],
            'motor' => [
                'w' => (float) $latest->motor_power_watt,
                'wh_today' => $motorWh,
                'kwh_today' => $motorWh / 1000,
            ],
            'net' => [
                'w' => (float) $latest->net_power_watt,
                'wh_today' => $yieldWh - $motorWh,
                'kwh_today' => ($yieldWh - $motorWh) / 1000,
                'extra_vs_fixed_pct' => null,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function historySeries(): array
    {
        $latest = SolarMeasurement::query()->latest('measurement_time')->firstOrFail();
        $day = Carbon::parse($latest->measurement_time)->toDateString();
        $measurements = $this->measurementsForDay($day);
        $hourly = $measurements->groupBy(
            fn (SolarMeasurement $measurement): string => Carbon::parse($measurement->measurement_time)->format('H:00')
        );

        $hours = $hourly->keys()->values()->all();
        $yieldKw = $hourly->map(fn (Collection $rows): float => round($rows->avg('power_watt') / 1000, 3))->values()->all();
        $motorW = $hourly->map(fn (Collection $rows): float => round($rows->avg('motor_power_watt'), 1))->values()->all();
        $netWh = $hourly->map(fn (Collection $rows): float => round($this->energyWh($rows, 'net_power_watt'), 2))->values()->all();

        $daily = SolarMeasurement::query()
            ->selectRaw('DATE(measurement_time) as day')
            ->selectRaw('SUM(power_watt) / 120 as yield_wh')
            ->selectRaw('SUM(net_power_watt) / 120 as net_wh')
            ->groupBy('day')
            ->orderByDesc('day')
            ->limit(7)
            ->get()
            ->sortBy('day');

        return [
            'intraday' => [
                'labels' => $hours,
                'yield_kw' => $yieldKw,
                'motor_w' => $motorW,
            ],
            'daily' => [
                'labels' => $daily->map(fn ($row): string => Carbon::parse($row->day)->format('d-m'))->values()->all(),
                'yield_kwh' => $daily->map(fn ($row): float => round($row->yield_wh / 1000, 2))->values()->all(),
                'net_kwh' => $daily->map(fn ($row): float => round($row->net_wh / 1000, 2))->values()->all(),
            ],
            'net_cumulative_wh' => $netWh,
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function measurementLog(): array
    {
        return SolarMeasurement::query()
            ->latest('measurement_time')
            ->limit(8)
            ->get()
            ->map(fn (SolarMeasurement $measurement): array => [
                'time' => Carbon::parse($measurement->measurement_time)->format('H:i:s'),
                'status' => $this->statusKey($measurement->status),
                'angle' => (float) $measurement->position,
                'yield_w' => (float) $measurement->power_watt,
                'motor_w' => (float) $measurement->motor_power_watt,
            ])
            ->all();
    }

    private function measurementsForDay(string $day): Collection
    {
        return SolarMeasurement::query()
            ->whereDate('measurement_time', $day)
            ->orderBy('measurement_time')
            ->get();
    }

    private function energyWh(Collection $measurements, string $column): float
    {
        return round($measurements->sum($column) / 120, 2);
    }

    private function statusKey(string $status): string
    {
        return match (mb_strtolower($status)) {
            'actief', 'active' => 'actief',
            'handmatig', 'manual' => 'handmatig',
            'storing', 'error', 'fault' => 'storing',
            'veilige stand', 'safe', 'safe mode' => 'veilige_stand',
            default => 'actief',
        };
    }
}