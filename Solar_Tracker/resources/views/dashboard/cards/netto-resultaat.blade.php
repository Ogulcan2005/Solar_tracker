{{-- Kaart 3: opbrengst minus motorverbruik. --}}
<section class="metric-card metric-card--petrol">
    <div class="metric-card__header">
        <div class="metric-card__title">
            <span class="metric-card__icon" aria-hidden="true">✅</span>
            <h2 class="metric-card__heading">Netto resultaat</h2>
        </div>
        @if ($live['net']['extra_vs_fixed_pct'] !== null)
            <span class="metric-card__badge">
                +{{ number_format($live['net']['extra_vs_fixed_pct'], 1, ',', '.') }}%
            </span>
        @endif
    </div>

    <p class="metric-card__value">
        {{ number_format($live['net']['w'], 0, ',', '.') }}
        <span class="metric-card__unit">W</span>
    </p>
    <p class="metric-card__total">
        Vandaag totaal: <strong>{{ number_format($live['net']['kwh_today'], 2, ',', '.') }} kWh</strong>
    </p>
    <p class="metric-card__help">Opbrengst min motorverbruik. Positief = de tracker levert winst op.</p>
</section>
