<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute publik website portofolio Wahyu Dwi Utomo.
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
