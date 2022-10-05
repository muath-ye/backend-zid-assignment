<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/items/{item}', [ItemController::class, 'show']);
Route::put('/items/{item}', [ItemController::class, 'update']);
Route::get('/statistics/items-count', [StatisticsController::class, 'itemsCount']);
Route::get('/statistics/average-price', [StatisticsController::class, 'averagePrice']);
Route::get('/statistics/{website}/highest-total-price', [StatisticsController::class, 'highestTotalPrice']);
Route::get('/statistics/last-month-total-price', [StatisticsController::class, 'lastMonthTotalPrice']);
