<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::get('/kendaraan/{id}', [KendaraanController::class, 'show']);
Route::post('user/register', [AuthController::class, 'register']);
Route::post('user/login', [AuthController::class, 'login']);
Route::post('admin/register', [AdminController::class, 'register']);
Route::post('admin/login', [AdminController::class, 'login']);



Route::middleware('auth:sanctum','abilities:user')->group(function(){
    Route::get('/formulir', [FormulirController::class, 'index']);
    Route::post('/formulir', [FormulirController::class, 'store']);
    Route::get('/formulir/{id}', [FormulirController::class, 'show']);
    Route::post('user/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum','abilities:user']);
    Route::put('/formulir/history', [AuthController::class, 'getHistory'])->middleware(['auth:sanctum','abilities:user']);
});

Route::middleware('auth:sanctum','abilities:admin')->group(function(){
    Route::post('/kendaraan', [KendaraanController::class, 'store']);   
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update']);
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy']);
    Route::get('/formulirs', [FormulirController::class, 'index']);
    Route::get('/formulirs/{id}', [FormulirController::class, 'show']);
    Route::put('/formulirs/{id}', [FormulirController::class, 'update']);
    Route::post('admin/logout', [AdminController::class, 'logout']);
});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
