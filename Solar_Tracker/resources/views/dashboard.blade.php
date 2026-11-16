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
    {{-- Elk dashboardonderdeel staat in een eigen Blade-view om wijzigingen overzichtelijk te houden. --}}
    @include('dashboard.blocks.intro')
    @include('dashboard.blocks.status')
    @include('dashboard.blocks.position')
    @include('dashboard.blocks.energy')
    @include('dashboard.blocks.display-options')
    @include('dashboard.blocks.history')
    @include('dashboard.blocks.measurement-log')
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
                    document.querySelectorAll(group).forEach((button) => {
                        button.className = button.className
                            .replace(/bg-\[var\(--esg-petrol\)\]/g, '')
                            .replace(/bg-\[var\(--esg-gold\)\]/g, '')
                            .replace(/text-white/g, '')
                            .replace(/text-\[var\(--esg-petrol\)\]/g, '')
                            .replace(/font-semibold/g, '');
                        if (!button.classList.contains('border')) {
                            button.classList.add('border', 'border-[var(--esg-mist)]', 'text-[var(--esg-teal)]');
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
