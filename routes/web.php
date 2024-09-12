<?php

use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;
use App\Http\Controllers\BookController;
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
    return view('welcome');
});

// Route::post('/book', [BookController::class, 'store']);

// Route::get('/book', [BookController::class, 'index']);

// Route::put('/book/{id}', [BookController::class, 'update']);

// Route::delete('/book/{id}', [BookController::class, 'delete']);
