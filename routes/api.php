<?php

use App\Http\Controllers\Api\{
    ApiPaymentApprovalController,
    ApiPaymentsController,
    ApiReportsApprovedPaymentsController,
    ApiTravelPaymentsController
};

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('payments', ApiPaymentsController::class);
    Route::resource('travel_payments', ApiTravelPaymentsController::class);

    Route::resource('payments_approval', ApiPaymentApprovalController::class);
});


Route::resource('approved_payments/reports', ApiReportsApprovedPaymentsController::class);
