<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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
    return view('main.main');
});

Route::resource('orders', OrderController::class)->only(['store', 'update', 'index', 'show']);
Route::post('orders/verify/{order}', [OrderController::class, 'verify'] )->name('verify');


