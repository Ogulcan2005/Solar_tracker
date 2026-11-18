<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(){
        $response = Http::get('https://weerlive.nl/api/weerlive_api_v2.php', [
            'key' => '50c8363009',
            'locatie' => 'Dordracht',
        ]);
        $weather = [];
        if($response->successful()){
            $data = $response->json();
            $weather = data_get($data ?? [], 'liveweer.0', []);
        }
        return view('dashboard', compact('weather'));
    }
    
}
