<?php

use App\Http\Controllers\Api\{
    ApiPaymentsController,
    ApiReportsApprovedPayments,
    ApiTravelPaymentsController
};

use Illuminate\Support\Facades\Route;


Route::resource('payments', ApiPaymentsController::class)->middleware('auth:sanctum');
Route::resource('travel_payments', ApiTravelPaymentsController::class)->middleware('auth:sanctum');
Route::resource('approved_payments/reports', ApiReportsApprovedPayments::class);
