<?php

use App\Domain\Weather\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware(['api'])->group(function () {
    Route::get('/all', [WeatherController::class, 'getAll']);
    Route::get('/city', [WeatherController::class, 'getByCity']);
});
