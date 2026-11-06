<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather()
    {
        $response = Http::get('https://weerlive.nl/api/weerlive_api_v2.php', [
            'key' => '50c8363009',
            'locatie' => 'Dordrecht',
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Haal de actuele temperatuur uit het JSON-antwoord
            $temperatuur = $data['liveweer'][0]['temp'] ?? null;

            return view('weather', compact('temperatuur', 'data'));
        }

        return back()->with('error', 'Kon de weergegevens niet ophalen.');
    }
}