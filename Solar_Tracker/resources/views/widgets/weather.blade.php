<div class="grid grid-cols-1 md:grid-cols-4 gap-2">
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        @if(!empty($weather))
            <div class="text-lg font-semibold text-gray-700">
                {{ $weather['plaats'] ?? 'Onbekende locatie' }}                
            </div>
            <div class="text-4xl font-bold my-2">
                {{ $weather['temp'] ?? 'Onbekende temperatuur' }} °C
            </div>
            <div class="text-lg font-semibold text-gray-700">
                {{ $weather['samenv'] ?? 'Onbekend weer' }}
            </div>
            <div class="text-lg font-semibold text-gray-700">
                {{ $weather['windms'] ?? 'Onbekende wind' }} m/s windrichting: {{ $weather['windr'] ?? 'Onbekende windrichting' }}
            </div>
        @endif
    </div>
</div>
