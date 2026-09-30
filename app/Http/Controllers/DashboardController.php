<?php

namespace App\Http\Controllers;

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
        return [
            'status' => 'actief',
            'status_label' => 'Actief',
            'updated_at' => now()->format('d-m-Y H:i:s'),
            'position_deg' => 47.5,
            'target_deg' => 48.0,
            'yield' => [
                'w' => 842,
                'wh_today' => 4.82,
                'kwh_today' => 4.82,
            ],
            'motor' => [
                'w' => 18,
                'wh_today' => 0.09,
                'kwh_today' => 0.09,
            ],
            'net' => [
                'w' => 824,
                'wh_today' => 4.73,
                'kwh_today' => 4.73,
                'extra_vs_fixed_pct' => 12.4,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function historySeries(): array
    {
        $hours = [];
        $yieldKw = [];
        $motorW = [];
        $netWh = [];

        for ($h = 6; $h <= 18; $h++) {
            $hours[] = sprintf('%02d:00', $h);
            $sun = max(0, sin(($h - 6) / 12 * M_PI));
            $yieldKw[] = round($sun * 0.95 + (mt_rand(-5, 5) / 100), 2);
            $motorW[] = $sun > 0.1 ? mt_rand(12, 28) : 0;
            $netWh[] = round(($yieldKw[count($yieldKw) - 1] * 1000 - $motorW[count($motorW) - 1]) * 0.25, 0);
        }

        $days = ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'];
        $dailyKwh = [3.2, 4.1, 3.8, 4.9, 5.2, 4.6, 4.8];
        $dailyNet = [3.05, 3.92, 3.64, 4.71, 5.01, 4.44, 4.63];

        return [
            'intraday' => [
                'labels' => $hours,
                'yield_kw' => $yieldKw,
                'motor_w' => $motorW,
            ],
            'daily' => [
                'labels' => $days,
                'yield_kwh' => $dailyKwh,
                'net_kwh' => $dailyNet,
            ],
            'net_cumulative_wh' => $netWh,
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function measurementLog(): array
    {
        $rows = [];
        $t = now()->startOfHour();

        for ($i = 0; $i < 8; $i++) {
            $rows[] = [
                'time' => $t->copy()->subMinutes($i * 15)->format('H:i'),
                'status' => $i === 0 ? 'actief' : ($i === 5 ? 'handmatig' : 'actief'),
                'angle' => 45 + $i * 0.3,
                'yield_w' => 780 + mt_rand(-40, 60),
                'motor_w' => mt_rand(10, 22),
            ];
        }

        return $rows;
    }
}
