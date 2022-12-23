<?php

use App\Http\Controllers\FractionController;
use App\Http\Controllers\MeterReadingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('fractions', [FractionController::class, 'store']);
Route::put('fractions/{id}', [FractionController::class, 'update']);
Route::get('fractions/{id}', [FractionController::class, 'find']);
Route::delete('fractions/{id}', [FractionController::class, 'delete']);

Route::post('meterReadings', [MeterReadingController::class, 'store']);
Route::put('meterReadings/{id}', [MeterReadingController::class, 'update']);
Route::get('meterReadings/{id}', [MeterReadingController::class, 'find']);
Route::delete('meterReadings/{id}', [MeterReadingController::class, 'delete']);
Route::get('meterReadings/consumption/{month}', [MeterReadingController::class, 'getConsumption']);
