<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\StanokController;
use App\Http\Controllers\TableController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/monitoring', [HistoryController::class, 'index'])->name('monitoring.index');

Route::get('/monitoring/search', [HistoryController::class, 'search'])->name('monitoring.search');

Route::get('/monitoring/create', [HistoryController::class, 'create'])->name('monitoring.create');

Route::get('/monitoring/edit', [HistoryController::class, 'edit'])->name('monitoring.edit');

Route::patch('/monitoring', [HistoryController::class, 'update'])->name('monitoring.update');

Route::get('/monitoring/deleting', [HistoryController::class, 'deleteData'])->name('monitoring.deleteData');

Route::get('/monitoring/delete', [HistoryController::class, 'destroy'])->name('monitoring.delete');

Route::get('/monitoring/restore', [HistoryController::class, 'restore'])->name('monitoring.restore');
Route::post('/monitoring', [HistoryController::class, 'store'])->name('monitoring.store');

Route::get('/monitoring/sending', [HistoryController::class, 'setOrUpdateData'])->name('monitoring.sending');

Route::get('/monitoring/presentation', [ArchiveController::class, 'index'])->name('monitoring.show');
Route::get('/monitoring/presentation/print', [ArchiveController::class, 'show'])->name('monitoring.print');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
