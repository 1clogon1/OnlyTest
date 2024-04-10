<?php

use App\Http\Controllers\AutoController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RentCarController;
use App\Http\Controllers\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Регистрация
Route::post('/worker/register', [WorkerController::class,'register']);

Route::middleware(['auth:worker_token'])->group(function(){
//Вывод
Route::get('/auto', [AutoController::class,'index']);

Route::get('/driver', [DriverController::class,'index']);

Route::get('/rent_car', [RentCarController::class,'index']);
    Route::get('/rent_car/category', [RentCarController::class,'index_category']);
    Route::get('/rent_car/model', [RentCarController::class,'index_model']);

Route::get('/worker', [WorkerController::class,'index']);



//Отправка
Route::post('/auto/create', [AutoController::class,'create']);

Route::post('/driver/create', [DriverController::class,'create']);

Route::post('/rent_car/create', [RentCArController::class,'create']);

Route::post('/worker/create', [WorkerController::class,'create']);
});


