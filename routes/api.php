<?php

use App\Http\Controllers\Api\{
    ApiPaymentsController,
    ApiTravelPaymentsController
};

use Illuminate\Support\Facades\Route;


Route::resource('payments', ApiPaymentsController::class)->middleware('auth:sanctum');
Route::resource('travel_payments', ApiTravelPaymentsController::class)->middleware('auth:sanctum');

