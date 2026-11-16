{{-- Dit blok laat de huidige bedrijfsmodus van de tracker zien. --}}
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
