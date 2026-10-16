@extends('layouts.dashboard')

@section('title', 'Solar Tracker')

@php
    $statusStyles = [
        'actief' => 'bg-[#dcfce7] text-[#166534] border-[#86efac]',
        'handmatig' => 'bg-[#fef9c3] text-[#854d0e] border-[#fde047]',
        'storing' => 'bg-[#fee2e2] text-[#991b1b] border-[#fca5a5]',
        'veilige_stand' => 'bg-[#e0f2fe] text-[#075985] border-[#7dd3fc]',
    ];
    $statusLabels = [
        'actief' => 'Actief',
        'handmatig' => 'Handmatig',
        'storing' => 'Storing',
        'veilige_stand' => 'Veilige stand',
    ];
    $statusHelp = [
        'actief' => 'Het paneel volgt automatisch de zon.',
        'handmatig' => 'Jij stuurt de positie handmatig aan.',
        'storing' => 'Er is een probleem — controleer het systeem.',
        'veilige_stand' => 'Het paneel staat veilig stil (bijv. bij storm).',
    ];
    $currentStatus = $live['status'];
@endphp

@section('content')
    {{-- Intro --}}
    <div class="mb-6 rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
        <p class="inline-block rounded-full bg-[var(--esg-gold)] px-3 py-1 text-xs font-bold text-[var(--esg-petrol)]">
            Demo · voorbeelddata
        </p>
        <h1 class="mt-3 text-2xl font-bold text-[var(--esg-petrol)]">Welkom bij je Solar Tracker</h1>
        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-[var(--esg-teal)]">
            Dit dashboard laat in één oogopslag zien hoe je zonnepaneel draait.
            Alle cijfers hieronder zijn <strong>dummy data</strong> — bedoeld om te oefenen en te leren.
        </p>
        <p class="mt-2 text-xs text-[var(--esg-teal)]/70">Laatste update: {{ $live['updated_at'] }}</p>
    </div>

    {{-- 1. Systeemstatus --}}
    <section class="mb-6 rounded-2xl border-2 border-[var(--esg-petrol)] bg-white p-5 shadow-sm">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[var(--esg-petrol)]">
            <span aria-hidden="true">🟢</span> 1. Systeemstatus
        </h2>
        <p class="mt-1 text-sm text-[var(--esg-teal)]">In welke modus staat de tracker op dit moment?</p>

        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($statusLabels as $key => $label)
                <span @class([
                    'rounded-xl border-2 px-4 py-2 text-sm font-semibold',
                    $statusStyles[$key],
                    'ring-2 ring-[var(--esg-gold)] ring-offset-2' => $key === $currentStatus,
                    'opacity-50' => $key !== $currentStatus,
                ])>
                    @if ($key === $currentStatus) ✓ @endif
                    {{ $label }}
                </span>
            @endforeach
        </div>
        <p class="mt-4 rounded-xl bg-[var(--esg-mist)] px-4 py-3 text-sm text-[var(--esg-petrol)]">
            <strong>Nu:</strong> {{ $statusHelp[$currentStatus] ?? '' }}
        </p>
    </section>

    {{-- 2. Positie --}}
    <section class="mb-6 rounded-2xl border-2 border-[var(--esg-teal)] bg-white p-5 shadow-sm">
        <h2 class="flex items-center gap-2 text-lg font-bold text-[var(--esg-petrol)]">
            <span aria-hidden="true">📐</span> 2. Positie
        </h2>
        <p class="mt-1 text-sm text-[var(--esg-teal)]">Hoe ver is het paneel gedraaid ten opzichte van de grond?</p>

        <div class="mt-4 grid gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm font-medium text-[var(--esg-teal)]">Actuele hoek</p>
                <p class="mt-1 text-5xl font-bold tabular-nums text-[var(--esg-petrol)]">
                    {{ number_format($live['position_deg'], 1, ',', '.') }}°
                </p>
                <p class="mt-2 text-sm text-[var(--esg-teal)]">
                    Doelhoek: <strong>{{ number_format($live['target_deg'], 1, ',', '.') }}°</strong>
                </p>
            </div>
            <div class="flex flex-col items-center justify-center rounded-xl bg-[var(--esg-mist)] p-4">
                <div class="relative h-28 w-40">
                    <div class="absolute inset-x-2 bottom-2 h-2 rounded-full bg-[var(--esg-petrol)]/20"></div>
                    <div
                        class="absolute bottom-2 left-1/2 h-20 w-2 origin-bottom rounded-full bg-[var(--esg-gold)] shadow"
                        style="transform: translateX(-50%) rotate({{ $live['position_deg'] - 90 }}deg);"
                    ></div>
                    <div class="absolute -top-1 left-1/2 -translate-x-1/2 text-2xl" aria-hidden="true">☀️</div>
                </div>
                <p class="mt-2 text-xs text-[var(--esg-teal)]">Eenvoudige schets van de paneelstand</p>
            </div>
        </div>
    </section>

    {{-- 3–5. Opbrengst, motor, netto --}}
    <div class="mb-6">
        <h2 class="mb-3 flex items-center gap-2 text-lg font-bold text-[var(--esg-petrol)]">
            <span aria-hidden="true">📊</span> 3 t/m 5. Energie in cijfers
        </h2>
        <p class="mb-4 text-sm text-[var(--esg-teal)]">
            <strong>W</strong> = vermogen op dit moment ·
            <strong>kWh</strong> = totale energie vandaag
        </p>
        <div class="grid gap-4 md:grid-cols-3">
            <x-metric-card
                title="Opbrengst"
                icon="☀️"
                accent="gold"
                :power="$live['yield']['w']"
                :energy-today="$live['yield']['kwh_today']"
                help="Hoeveel stroom je paneel nu opwekt door de tracker."
            />
            <x-metric-card
                title="Motorverbruik"
                icon="⚙️"
                accent="teal"
                :power="$live['motor']['w']"
                :energy-today="$live['motor']['kwh_today']"
                help="Stroom die de motor gebruikt om het paneel te draaien."
            />
            <x-metric-card
                title="Netto resultaat"
                icon="✅"
                accent="petrol"
                :power="$live['net']['w']"
                :energy-today="$live['net']['kwh_today']"
                :badge="'+' . number_format($live['net']['extra_vs_fixed_pct'], 1, ',', '.') . '%'"
                help="Opbrengst min motorverbruik. Positief = de tracker levert winst op."
            />
        </div>
    </div>

    {{-- Weergave opties (demo) --}}
    <section class="mb-6 rounded-2xl border border-[var(--esg-mist)] bg-white p-4 shadow-sm">
        <p class="text-sm font-semibold text-[var(--esg-petrol)]">Weergave kiezen (demo)</p>
        <p class="mt-1 text-xs text-[var(--esg-teal)]">Later kun je hier schakelen tussen W, Wh, kWh en per seconde/minuut/uur/dag.</p>
        <div class="mt-3 flex flex-wrap gap-2">
            <button type="button" class="unit-btn rounded-lg bg-[var(--esg-petrol)] px-3 py-1.5 text-xs font-semibold text-white">W (nu)</button>
            <button type="button" class="unit-btn rounded-lg border border-[var(--esg-mist)] px-3 py-1.5 text-xs text-[var(--esg-teal)]">Wh</button>
            <button type="button" class="unit-btn rounded-lg border border-[var(--esg-mist)] px-3 py-1.5 text-xs text-[var(--esg-teal)]">kWh</button>
            <span class="mx-1 self-center text-[var(--esg-mist)]">|</span>
            <button type="button" class="interval-btn rounded-lg border border-[var(--esg-mist)] px-3 py-1.5 text-xs text-[var(--esg-teal)]">/sec</button>
            <button type="button" class="interval-btn rounded-lg border border-[var(--esg-mist)] px-3 py-1.5 text-xs text-[var(--esg-teal)]">/min</button>
            <button type="button" class="interval-btn rounded-lg border border-[var(--esg-mist)] px-3 py-1.5 text-xs text-[var(--esg-teal)]">/uur</button>
            <button type="button" class="interval-btn rounded-lg bg-[var(--esg-gold)] px-3 py-1.5 text-xs font-semibold text-[var(--esg-petrol)]">/dag</button>
        </div>
    </section>

    {{-- 6. Historie --}}
    <section class="mb-6">
        <h2 class="mb-3 flex items-center gap-2 text-lg font-bold text-[var(--esg-petrol)]">
            <span aria-hidden="true">📈</span> 6. Historie
        </h2>
        <p class="mb-4 text-sm text-[var(--esg-teal)]">Grafieken met opgeslagen meetgegevens (dummy).</p>

        <div class="grid gap-4 lg:grid-cols-2">
            <div class="rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-[var(--esg-petrol)]">Vermogen vandaag</h3>
                <p class="text-xs text-[var(--esg-teal)]">Geel = opbrengst (kW) · Blauwgroen = motor (W)</p>
                <div class="mt-4 h-56">
                    <canvas id="chart-intraday"></canvas>
                </div>
            </div>
            <div class="rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-[var(--esg-petrol)]">Energie per dag (deze week)</h3>
                <p class="text-xs text-[var(--esg-teal)]">Geel = bruto opbrengst · Donkergroen = netto</p>
                <div class="mt-4 h-56">
                    <canvas id="chart-daily"></canvas>
                </div>
            </div>
        </div>
    </section>

    {{-- Meetlog --}}
    <section class="rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
        <h3 class="font-semibold text-[var(--esg-petrol)]">Meetlog (laatste metingen)</h3>
        <p class="mt-1 text-xs text-[var(--esg-teal)]">Elke 15 minuten een nieuwe regel — alleen ter illustratie.</p>
        <div class="mt-4 overflow-x-auto">
            <table class="w-full min-w-[540px] text-left text-sm">
                <thead>
                    <tr class="border-b-2 border-[var(--esg-mist)] bg-[var(--esg-sand)] text-xs uppercase tracking-wide text-[var(--esg-teal)]">
                        <th class="px-3 py-3 font-semibold">Tijd</th>
                        <th class="px-3 py-3 font-semibold">Status</th>
                        <th class="px-3 py-3 font-semibold">Hoek</th>
                        <th class="px-3 py-3 font-semibold">Opbrengst</th>
                        <th class="px-3 py-3 font-semibold">Motor</th>
                        <th class="px-3 py-3 font-semibold">Netto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($log as $i => $row)
                        @php $netW = $row['yield_w'] - $row['motor_w']; @endphp
                        <tr @class(['border-b border-[var(--esg-mist)]', 'bg-[var(--esg-sand)]/50' => $i % 2 === 0])>
                            <td class="px-3 py-3 tabular-nums text-[var(--esg-teal)]">{{ $row['time'] }}</td>
                            <td class="px-3 py-3">
                                <span @class(['rounded-lg border px-2 py-0.5 text-xs font-medium', $statusStyles[$row['status']] ?? ''])>
                                    {{ $statusLabels[$row['status']] ?? $row['status'] }}
                                </span>
                            </td>
                            <td class="px-3 py-3 tabular-nums font-medium">{{ number_format($row['angle'], 1, ',', '.') }}°</td>
                            <td class="px-3 py-3 tabular-nums text-[var(--esg-goldDark)]">{{ $row['yield_w'] }} W</td>
                            <td class="px-3 py-3 tabular-nums text-[var(--esg-teal)]">{{ $row['motor_w'] }} W</td>
                            <td class="px-3 py-3 tabular-nums font-bold text-[var(--esg-petrol)]">{{ $netW }} W</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const history = @json($history);
            const petrol = '#00464f';
            const teal = '#1A8593';
            const gold = '#fdd400';
            const grid = 'rgba(0, 70, 79, 0.08)';

            Chart.defaults.font.family = "'Instrument Sans', sans-serif";
            Chart.defaults.color = teal;

            new Chart(document.getElementById('chart-intraday'), {
                type: 'line',
                data: {
                    labels: history.intraday.labels,
                    datasets: [
                        {
                            label: 'Opbrengst (kW)',
                            data: history.intraday.yield_kw,
                            borderColor: gold,
                            backgroundColor: 'rgba(253, 212, 0, 0.15)',
                            fill: true,
                            tension: 0.3,
                            borderWidth: 3,
                            yAxisID: 'y',
                        },
                        {
                            label: 'Motor (W)',
                            data: history.intraday.motor_w,
                            borderColor: teal,
                            backgroundColor: 'transparent',
                            tension: 0.3,
                            borderWidth: 2,
                            yAxisID: 'y1',
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                    scales: {
                        x: { grid: { color: grid } },
                        y: { position: 'left', grid: { color: grid }, title: { display: true, text: 'kW' } },
                        y1: { position: 'right', grid: { drawOnChartArea: false }, title: { display: true, text: 'W' } },
                    },
                },
            });

            new Chart(document.getElementById('chart-daily'), {
                type: 'bar',
                data: {
                    labels: history.daily.labels,
                    datasets: [
                        {
                            label: 'Opbrengst (kWh)',
                            data: history.daily.yield_kwh,
                            backgroundColor: gold,
                            borderRadius: 8,
                        },
                        {
                            label: 'Netto (kWh)',
                            data: history.daily.net_kwh,
                            backgroundColor: petrol,
                            borderRadius: 8,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                    scales: {
                        x: { grid: { display: false } },
                        y: { grid: { color: grid }, title: { display: true, text: 'kWh' } },
                    },
                },
            });

            document.querySelectorAll('.unit-btn, .interval-btn').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const group = btn.classList.contains('unit-btn') ? '.unit-btn' : '.interval-btn';
                    document.querySelectorAll(group).forEach((b) => {
                        b.className = b.className
                            .replace(/bg-\[var\(--esg-petrol\)\]/g, '')
                            .replace(/bg-\[var\(--esg-gold\)\]/g, '')
                            .replace(/text-white/g, '')
                            .replace(/text-\[var\(--esg-petrol\)\]/g, '')
                            .replace(/font-semibold/g, '');
                        if (!b.classList.contains('border')) {
                            b.classList.add('border', 'border-[var(--esg-mist)]', 'text-[var(--esg-teal)]');
                        }
                    });
                    btn.classList.remove('border', 'border-[var(--esg-mist)]', 'text-[var(--esg-teal)]');
                    if (btn.classList.contains('unit-btn')) {
                        btn.classList.add('bg-[var(--esg-petrol)]', 'text-white', 'font-semibold');
                    } else {
                        btn.classList.add('bg-[var(--esg-gold)]', 'text-[var(--esg-petrol)]', 'font-semibold');
                    }
                });
            });
        });
    </script>
@endpush
