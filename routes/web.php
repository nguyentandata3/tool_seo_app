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
    return view('master');
});
Route::prefix('serprobot/')->name('serprobot.')->group(function () {
    Route::get('', [SerprobotController::class, 'index'])->name('index');
    Route::get('get_apikey', [SerprobotController::class, 'get_apikey'])->name('get_apikey');
    Route::post('post_apikey', [SerprobotController::class, 'post_apikey'])->name('post_apikey');

    Route::get('get_project/{project_id}', [SerprobotController::class, 'get_project'])->name('get_project');
    Route::get('post_project/{project_id}', [SerprobotController::class, 'post_project'])->name('post_project');

    Route::get('get_keyword/{project_id}/{keyword_id}', [SerprobotController::class, 'get_keyword'])->name('get_keyword');
    Route::post('post_keyword/{project_id}/{keyword_id}', [SerprobotController::class, 'post_keyword'])->name('post_keyword');

    Route::get('get_seorank/{project_id}/{keyword_id}', [SerprobotController::class, 'get_seorank'])->name('get_seorank');
    Route::get('post_seorank/{project_id}/{keyword_id}', [SerprobotController::class, 'post_seorank'])->name('post_seorank');
});

