{{-- Kaart 1: actuele opbrengst en totale energieopbrengst van de geselecteerde dag. --}}
<section class="metric-card metric-card--gold">
    <div class="metric-card__header">
        <div class="metric-card__title">
            <span class="metric-card__icon" aria-hidden="true">☀️</span>
            <h2 class="metric-card__heading">Opbrengst</h2>
        </div>
    </div>

    <p class="metric-card__value">
        {{ number_format($live['yield']['w'], 0, ',', '.') }}
        <span class="metric-card__unit">W</span>
    </p>
    <p class="metric-card__total">
        Vandaag totaal: <strong>{{ number_format($live['yield']['kwh_today'], 2, ',', '.') }} kWh</strong>
    </p>
    <p class="metric-card__help">Hoeveel stroom je paneel nu opwekt door de tracker.</p>
</section>
