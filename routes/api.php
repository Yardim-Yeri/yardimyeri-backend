<?php

use App\Http\Controllers\API\CaseController;
use App\Http\Controllers\API\HelpController;
use App\Http\Controllers\API\HelperController;
use App\Http\Controllers\API\NeedsController;
use App\Http\Controllers\ApiController;
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

Route::get('/streets/{neighborhood}', [HelperController::class, 'getStreets']);
Route::get('/neighborhoods/{district}', [HelperController::class, 'getNeighborhoods']);
Route::get('/districts/{province}', [HelperController::class, 'getDistricts']);
Route::get('/provinces', [HelperController::class, 'getProvinces']);

Route::post('/send-help-form', [ApiController::class, 'sendHelpForm'])->name('api-send-yardim-talebi-form');
Route::post('/send-helper-form/{help_data_id}', [HelperController::class, 'sendHelperForm']);

Route::apiResource('help', HelpController::class);

Route::get('/needs', [NeedsController::class, 'index']);
Route::get('/get-country-data', [ApiController::class, 'getCountryData']);
Route::post('/change-help-status/{id}', [ApiController::class, 'changeHelpStatus'])->name('api-change-help-status');

Route::get('/export/help', [ApiController::class, 'exportSpreadsheet'])->name('api.export-spreadsheet');

Route::get('/case/{base64}', [CaseController::class, 'index']);

Route::get('/case-finish/{base64}', [CaseController::class, 'finish']);
Route::get('/case-cancel/{base64}', [CaseController::class, 'cancel']);
