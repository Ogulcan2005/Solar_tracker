{{-- Dit blok toont de actuele positie van het zonnepaneel en een eenvoudige visuele weergave. --}}
<section class="mb-6 rounded-2xl border-2 border-[var(--esg-teal)] bg-white p-5 shadow-sm">
    <h2 class="flex items-center gap-2 text-lg font-bold text-[var(--esg-petrol)]">
        <span aria-hidden="true">📐</span> 2. Positie
    </h2>
    <p class="mt-1 text-sm text-[var(--esg-teal)]">Hoe ver is het paneel gedraaid ten opzichte van de grond?</p>

    <div class="mt-4 grid gap-6 sm:grid-cols-2">
        {{-- Linkerkant: actuele hoek en eventuele doelhoek uit de meetdata. --}}
        <div>
            <p class="text-sm font-medium text-[var(--esg-teal)]">Actuele hoek</p>
            <p class="mt-1 text-5xl font-bold tabular-nums text-[var(--esg-petrol)]">
                {{ number_format($live['position_deg'], 1, ',', '.') }}°
            </p>
            <p class="mt-2 text-sm text-[var(--esg-teal)]">
                Doelhoek:<strong>
                {{ $live['target_deg'] !== null
                    ? number_format($live['target_deg'], 1, ',', '.') . '°'
                    : 'Niet beschikbaar in CSV' }}</strong>
            </p>
        </div>
        {{-- Rechterkant: schets die meedraait met de actuele paneelhoek. --}}
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
