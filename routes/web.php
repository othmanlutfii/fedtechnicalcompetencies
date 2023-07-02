<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechnicalcompController;

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

Route::get('/',[TechnicalcompController::class, 'index']);
Route::get('/cari',[TechnicalcompController::class, 'cari'])->name('web.search');
