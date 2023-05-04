<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
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

Route::get('/', [AuthController::class,'login']);
Route::post('/login', [AuthController::class,'AuthLogin']);
Route::get('/logout', [AuthController::class,'logout']);
Route::get('/dashboard', function () {
    return view('main');
});
Route::get('/dashboard/create', function () {
    return view('main');
});

Route::resource("/student", StudentController::class);
// Route::get('/', function () {
//     return view('welcome');
// });
