<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EvaluationController;
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

// Evaluation Controller Paths
Route::resource('/', EvaluationController::class);

// Candidate Controller Paths
Route::resource('/candidatos', CustomerController::class)->middleware('api.verify');

Route::put('/candidatos/{id}', [CustomerController::class, 'update'])->middleware('api.verify');
Route::delete('/candidatos/{id}', [CustomerController::class, 'destroy'])->middleware('api.verify');
