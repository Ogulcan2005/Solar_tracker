{{-- Dit blok bevat de twee grafieken met historische meetgegevens. --}}
<section class="mb-6">
    <h2 class="mb-3 flex items-center gap-2 text-lg font-bold text-[var(--esg-petrol)]">
        <span aria-hidden="true">📈</span> 6. Historie
    </h2>
    <p class="mb-4 text-sm text-[var(--esg-teal)]">Grafieken met opgeslagen meetgegevens (dummy).</p>

    <div class="grid gap-4 lg:grid-cols-2">
        <div class="rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
            <h3 class="font-semibold text-[var(--esg-petrol)]">Vermogen vandaag</h3>
            <p class="text-xs text-[var(--esg-teal)]">Geel = opbrengst (kW) · Blauwgroen = motor (W)</p>
            <div class="mt-4 h-56"><canvas id="chart-intraday"></canvas></div>
        </div>
        <div class="rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
            <h3 class="font-semibold text-[var(--esg-petrol)]">Energie per dag (deze week)</h3>
            <p class="text-xs text-[var(--esg-teal)]">Geel = bruto opbrengst · Donkergroen = netto</p>
            <div class="mt-4 h-56"><canvas id="chart-daily"></canvas></div>
        </div>
    </div>
</section>
