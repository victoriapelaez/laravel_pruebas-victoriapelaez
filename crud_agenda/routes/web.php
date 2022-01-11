<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('agenda', AgendaController::class)->middleware(['auth']);
require __DIR__.'/auth.php';
