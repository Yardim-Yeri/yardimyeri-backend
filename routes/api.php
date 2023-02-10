<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['client']], function () {
    Route::get('/get-country-data', [ApiController::class, 'getCountryData']);
    Route::post('/send-yardim-talebi-form', [ApiController::class, 'sendYardimTalebiForm'])->name('api-send-yardim-talebi-form');
    Route::post('/change-help-status/{id}', [ApiController::class, 'changeHelpStatus'])->name('api-change-help-status');

    Route::get('/export/help', [ApiController::class, 'exportSpreadsheet'])->name('api.export-spreadsheet');
});
