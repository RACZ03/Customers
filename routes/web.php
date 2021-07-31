<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', CustomerController::class)->middleware('api.verify');
// Route::get('/all', [CustomerController::class, 'index']);

Route::put('/{id}', [CustomerController::class, 'update'])->middleware('api.verify');
Route::delete('/{id}', [CustomerController::class, 'destroy'])->middleware('api.verify');