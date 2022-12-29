<?php

use App\Http\Controllers\Api\{
    ApiPaymentsController
};

use Illuminate\Support\Facades\Route;


Route::resource('payments', ApiPaymentsController::class)->middleware('auth:sanctum');

