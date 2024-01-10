<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BladeController;
use App\Http\Controllers\MainController;

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
    return redirect('/crew');
});

Route::get('/login', [BladeController::class, 'login']);
Route::get('/crew', [BladeController::class, 'crew']);
Route::get('/user', [BladeController::class, 'user']);
Route::get('/rank', [BladeController::class, 'rank']);
Route::get('/document', [BladeController::class, 'document']);
Route::post('/api-request', [MainController::class, 'getrequest']);
