<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/info', [InfoController::class, 'index'])->name('info');
Route::post('/info/confirm', [InfoController::class, 'confirm'])->name('info.confirm');
Route::post('/info/complete', [InfoController::class, 'complete'])->name('info.complete');
Route::get('/info', [InfoController::class, 'index'])->name('info.index');
Route::get('/control', [App\Http\Controllers\ContactController::class, 'index'])->name('control');
Route::delete('/control/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');
