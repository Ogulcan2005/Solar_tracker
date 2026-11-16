{{-- Demo-knoppen voor toekomstige eenheden en tijdsintervallen. --}}
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
