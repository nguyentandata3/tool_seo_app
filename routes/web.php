<?php

use App\Http\Controllers\SerprobotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeorankController;
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
    return view('serprobot.index');
});

Route::prefix('serprobot/')->name('serprobot.')->group(function () {
    Route::get('', [SerprobotController::class, 'index'])->name('index');
    Route::get('show/{id}', [SerprobotController::class, 'show'])->name('show');
    Route::post('store', [SerprobotController::class, 'store'])->name('store');
    Route::get('seorank', [SerprobotController::class, 'seorank'])->name('seorank');
});

Route::prefix('seorank/')->name('seorank.')->group(function () {
    Route::get('', [SeorankController::class, 'index'])->name('index');
    Route::get('show/{id}', [SeorankController::class, 'show'])->name('show');
    Route::post('store', [SeorankController::class, 'store'])->name('store');

});
