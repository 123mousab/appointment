<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;


Route::prefix('admin')->middleware('auth:admin')->group(function (){

    Route::prefix('auth')->group(function (){
        Route::post('logout', [AdminController::class, 'logout']);
        Route::post('login', [AdminController::class, 'login'])->withoutMiddleware('auth:admin');
    });

    Route::prefix('service')->group(function (){
        Route::get('/', [ServiceController::class, 'index']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::get('/{id}', [ServiceController::class, 'find']);
        Route::post('/{id}/update', [ServiceController::class, 'update']);
        Route::delete('/{id}', [ServiceController::class, 'destroy']);
    });

    Route::prefix('user')->group(function (){
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'find']);
        Route::post('/{id}/update', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('appointment')->group(function (){
        Route::get('/', [AppointmentController::class, 'index']);
        Route::post('/', [AppointmentController::class, 'store']);
        Route::get('/{id}', [AppointmentController::class, 'find']);
        Route::put('/update_status', [AppointmentController::class, 'updateStatus']);
        Route::post('/{id}/update', [AppointmentController::class, 'update']);
        Route::delete('/{id}', [AppointmentController::class, 'destroy']);
    });
});
