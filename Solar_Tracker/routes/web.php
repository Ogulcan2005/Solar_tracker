<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolarMeasurementController;

Route::get('/', [SolarMeasurementController::class, 'index']);

Route::get('/solar', [SolarMeasurementController::class, 'index']);