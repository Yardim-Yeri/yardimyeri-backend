<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DemandController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Pages\UsefulLinksController;
use App\Http\Controllers\ReactiveHelpRequestController;
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

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/yardim-talebim-var', [PageController::class, 'yardimTalebimVar'])->name('yardim-talebim-var');
// Route::get('/yardimda-bulunabilirim/{id?}', [PageController::class, 'yardimdaBulunabilirim'])->name('yardimda-bulunabilirim');
// Route::get('yararli-linkler', [UsefulLinksController::class, 'index'])->name('yararli-linkler');

Route::get('login', [AuthController::class, 'index'])->name('get.login');
Route::post('login', [AuthController::class, 'login'])->name('post.login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('', function () {
        return redirect()->route('get.admin-demands');
    });
    Route::get('demands', [DemandController::class, 'index'])->name('get.admin-demands');
    Route::get('demands/{id}', [DemandController::class, 'show'])->name('show.admin-demand');
    Route::post('demands/{id}', [DemandController::class, 'update'])->name('update.admin-demand');
    Route::get('demands/update-approved-status/{id}', [DemandController::class, 'approved'])->name('update.admin-demand-approved');
    Route::post('demands/delete/{id}', [DemandController::class, 'destroy'])->name('delete.admin-demand');
    Route::get('users', [UsersController::class, 'index'])->name('get.admin-users');
    Route::post('users', [AuthController::class, 'register'])->name('store.admin-users');
    Route::get('users/delete/{id}', [UsersController::class, 'delete'])->name('delete.admin-users');
    Route::get('useful-links', [LinkController::class, 'index'])->name('get.useful-links');
    Route::post('useful-links', [LinkController::class, 'store'])->name('store.useful-links');
    Route::post('useful-links/update/{id}', [LinkController::class, 'update'])->name('update.useful-links');
    Route::get('useful-links/delete/{id}', [LinkController::class, 'delete'])->name('delete.useful-links');

    Route::get('districts/{province_id}',[DemandController::class,'getDistricts'])->name('get.districts');
    Route::get('neighborhood/{district_id}',[DemandController::class,'getNeighborhood'])->name('get.neighborhood');
    Route::get('street/{neighborhood_id}',[DemandController::class,'getStreet'])->name('get.street');



});

// Reactivate help request
Route::get('reactive/{base64}', [ReactiveHelpRequestController::class, 'index'])->name('reactive-help-request');
