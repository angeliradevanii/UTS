<?php

use App\Http\Controllers\BalitaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('balitas.index'));

Route::resource('balitas', BalitaController::class);
