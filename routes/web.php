<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoggerController;
use App\Http\Controllers\StatisticController;

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
    Redirect::to('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logger/pixel', [LoggerController::class, 'log'])->name('logger');

Route::middleware(['auth'])->group(function () {
    Route::get('statistics', [StatisticController::class, 'index'])->name('statistics.index');
    Route::get('statistics/requests', [StatisticController::class, 'requests'])->name('requests.index');
    Route::get('statistics/user-agents', [StatisticController::class, 'userAgentStatistics'])->name('requests.user-agents');
});
