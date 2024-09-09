<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [ContactController::class, 'contact']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/contact', [ContactController::class, 'store']);
Route::middleware('auth')->group(function () {
Route::get('/admin', [AuthController::class, 'index']);
});
Route::get('/contacts/search', [AuthController::class, 'search']);
Route::delete('/contacts/delete', [AuthController::class, 'destroy']);
