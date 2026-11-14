<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        @if (!empty($weather))
            <div class="text-lg font-semibold text-gray-700">
                {{ $weather['plaats'] ?? 'Onbekend' }}
            </div>
            
            <div class="text-4xl font-bold my-2">
                {{ $weather['temp'] ?? '--' }}°
            </div>
            
            <div class="text-gray-600 font-medium">
                {{ $weather['samenv'] ?? 'Geen gegevens' }}
            </div>
            
            <div class="text-sm text-gray-500 mt-1">
                windsnelheid: {{ $weather['windms'] ?? '--' }} m/s &nbsp; windrichting: {{ $weather['windr'] ?? '--' }}°
            </div>
        @else
            <p class="text-red-500">Geen weergegevens beschikbaar.</p>
        @endif
    </div>
</div>
