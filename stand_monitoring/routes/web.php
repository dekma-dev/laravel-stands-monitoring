<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\StanokController;
use App\Http\Controllers\TableController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/monitoring', [HistoryController::class, 'getData']);
Route::get('/monitoring/sending', [HistoryController::class, 'setData']);
Route::get('/monitoring/updating', [HistoryController::class, 'updateData']);
Route::get('/monitoring/deleting', [HistoryController::class, 'deleteData']);

Route::get('/table', [TableController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
