<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Pages\UsefulLinksController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/yardim-talebim-var', [PageController::class, 'yardimTalebimVar'])->name('yardim-talebim-var');
Route::get('/yardimda-bulunabilirim/{id?}', [PageController::class, 'yardimdaBulunabilirim'])->name('yardimda-bulunabilirim');
Route::get('yararli-linkler', [UsefulLinksController::class, 'index'])->name('yararli-linkler');
