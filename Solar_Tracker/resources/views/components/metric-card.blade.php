@props([
    'title',
    'icon' => '⚡',
    'accent' => 'teal',
    'power',
    'energyToday',
    'help' => null,
    'badge' => null,
])

@php
    $accents = [
        'gold' => [
            'border' => 'border-[var(--esg-gold)]',
            'bg' => 'bg-[#fffbeb]',
            'value' => 'text-[var(--esg-goldDark)]',
            'badge' => 'bg-[var(--esg-gold)] text-[var(--esg-petrol)]',
        ],
        'teal' => [
            'border' => 'border-[var(--esg-teal)]',
            'bg' => 'bg-[#f0fafa]',
            'value' => 'text-[var(--esg-teal)]',
            'badge' => 'bg-[var(--esg-teal)] text-white',
        ],
        'petrol' => [
            'border' => 'border-[var(--esg-petrol)]',
            'bg' => 'bg-white',
            'value' => 'text-[var(--esg-petrol)]',
            'badge' => 'bg-[var(--esg-petrol)] text-white',
        ],
    ];
    $a = $accents[$accent] ?? $accents['teal'];
@endphp

<section {{ $attributes->merge(['class' => 'rounded-2xl border-2 ' . $a['border'] . ' ' . $a['bg'] . ' p-5 shadow-sm']) }}>
    <div class="flex items-start justify-between gap-2">
        <div class="flex items-center gap-2">
            <span class="text-2xl" aria-hidden="true">{{ $icon }}</span>
            <h2 class="text-base font-semibold text-[var(--esg-petrol)]">{{ $title }}</h2>
        </div>
        @if ($badge)
            <span class="rounded-full px-2.5 py-0.5 text-xs font-bold {{ $a['badge'] }}">{{ $badge }}</span>
        @endif
    </div>

    <p class="mt-4 text-4xl font-bold tabular-nums {{ $a['value'] }}">
        {{ number_format($power, 0, ',', '.') }}
        <span class="text-xl font-semibold text-[var(--esg-teal)]">W</span>
    </p>
    <p class="mt-2 text-sm text-[var(--esg-teal)]">
        Vandaag totaal: <strong class="text-[var(--esg-petrol)]">{{ number_format($energyToday, 2, ',', '.') }} kWh</strong>
    </p>
    @if ($help)
        <p class="mt-3 rounded-lg bg-white/70 px-3 py-2 text-xs leading-relaxed text-[var(--esg-petrol)]/80">{{ $help }}</p>
    @endif
</section>
