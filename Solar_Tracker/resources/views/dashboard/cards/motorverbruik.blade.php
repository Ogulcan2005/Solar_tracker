{{-- Kaart 2: huidig en dagelijks verbruik van de motoren. --}}
<section class="metric-card metric-card--teal">
    <div class="metric-card__header">
        <div class="metric-card__title">
            <span class="metric-card__icon" aria-hidden="true">⚙️</span>
            <h2 class="metric-card__heading">Motorverbruik</h2>
        </div>
    </div>

    <p class="metric-card__value">
        {{ number_format($live['motor']['w'], 0, ',', '.') }}
        <span class="metric-card__unit">W</span>
    </p>
    <p class="metric-card__total">
        Vandaag totaal: <strong>{{ number_format($live['motor']['kwh_today'], 2, ',', '.') }} kWh</strong>
    </p>
    <p class="metric-card__help">Stroom die de motor gebruikt om het paneel te draaien.</p>
</section>
