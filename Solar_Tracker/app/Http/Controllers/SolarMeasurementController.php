<?php

namespace App\Http\Controllers;

use App\Models\SolarMeasurement;

class SolarMeasurementController extends Controller
{
    public function index()
    {
        $measurements = SolarMeasurement::latest()->get();

        return view('solar_measurements.index', [
            'measurements' => $measurements
        ]);
    }
}