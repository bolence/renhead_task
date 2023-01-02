<?php

use App\Http\Controllers\Api\{
    ApiPaymentApprovalController,
    ApiPaymentsController,
    ApiReportsApprovedPayments,
    ApiTravelPaymentsController
};

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('payments', ApiPaymentsController::class);
    Route::resource('travel_payments', ApiTravelPaymentsController::class);
    Route::resource('approved_payments/reports', ApiReportsApprovedPayments::class);
    Route::resource('payments_approval', ApiPaymentApprovalController::class);
});
