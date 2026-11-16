{{-- Dit blok toont de meest recente metingen uit de database. --}}
<section class="rounded-2xl border-2 border-[var(--esg-mist)] bg-white p-5 shadow-sm">
    <h3 class="font-semibold text-[var(--esg-petrol)]">Meetlog (laatste metingen)</h3>
    <p class="mt-1 text-xs text-[var(--esg-teal)]">Elke 15 minuten een nieuwe regel — alleen ter illustratie.</p>
    <div class="mt-4 overflow-x-auto">
        <table class="w-full min-w-[540px] text-left text-sm">
            <thead>
                <tr class="border-b-2 border-[var(--esg-mist)] bg-[var(--esg-sand)] text-xs uppercase tracking-wide text-[var(--esg-teal)]">
                    <th class="px-3 py-3 font-semibold">Tijd</th><th class="px-3 py-3 font-semibold">Status</th>
                    <th class="px-3 py-3 font-semibold">Hoek</th><th class="px-3 py-3 font-semibold">Opbrengst</th>
                    <th class="px-3 py-3 font-semibold">Motor</th><th class="px-3 py-3 font-semibold">Netto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($log as $i => $row)
                    @php $netW = $row['yield_w'] - $row['motor_w']; @endphp
                    <tr @class(['border-b border-[var(--esg-mist)]', 'bg-[var(--esg-sand)]/50' => $i % 2 === 0])>
                        <td class="px-3 py-3 tabular-nums text-[var(--esg-teal)]">{{ $row['time'] }}</td>
                        <td class="px-3 py-3"><span @class(['rounded-lg border px-2 py-0.5 text-xs font-medium', $statusStyles[$row['status']] ?? ''])>{{ $statusLabels[$row['status']] ?? $row['status'] }}</span></td>
                        <td class="px-3 py-3 tabular-nums font-medium">{{ number_format($row['angle'], 1, ',', '.') }}°</td>
                        <td class="px-3 py-3 tabular-nums text-[var(--esg-goldDark)]">{{ $row['yield_w'] }} W</td>
                        <td class="px-3 py-3 tabular-nums text-[var(--esg-teal)]">{{ $row['motor_w'] }} W</td>
                        <td class="px-3 py-3 tabular-nums font-bold text-[var(--esg-petrol)]">{{ $netW }} W</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
