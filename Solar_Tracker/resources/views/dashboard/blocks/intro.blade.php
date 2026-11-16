{{-- Introductie van het dashboard en het tijdstip van de laatste meting. --}}
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
