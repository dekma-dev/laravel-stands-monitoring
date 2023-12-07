<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\StanokController;
use App\Http\Controllers\TableController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/monitoring', [HistoryController::class, 'index'])->name('monitoring.index');
Route::get('/monitoring/search', [HistoryController::class, 'search'])->name('monitoring.search');
Route::get('/monitoring/create', [HistoryController::class, 'create'])->name('monitoring.create');
Route::get('/monitoring/edit', [HistoryController::class, 'edit'])->name('monitoring.edit');
// вместо update используется store action, суть та же, но архитектура не по конвенции laravel
Route::patch('/monitoring', [HistoryController::class, 'update'])->name('monitoring.update');
Route::get('/monitoring/deleting', [HistoryController::class, 'deleteData'])->name('monitoring.deleteData');
//delete по конвенции /monitoring с методом delete, обработчик - action with route, а у меня параша какая-то
Route::get('/monitoring/delete', [HistoryController::class, 'destroy'])->name('monitoring.delete');
Route::get('/monitoring/restore', [HistoryController::class, 'restore'])->name('monitoring.restore');
Route::post('/monitoring', [HistoryController::class, 'store'])->name('monitoring.store');

Route::get('/monitoring/sending', [HistoryController::class, 'setData']);
Route::get('/monitoring/updating', [HistoryController::class, 'updateData']);

Route::get('/monitoring/presentation', [ArchiveController::class, 'index'])->name('monitoring.show');
//проблема missing required parametr может заключаться в {} в роутах

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
