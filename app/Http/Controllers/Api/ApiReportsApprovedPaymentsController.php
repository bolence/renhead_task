<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;

class ApiReportsApprovedPaymentsController extends Controller
{
    /**
     * Sum of approved payments for every approver
     *
     * @return void
     */
    public function index()
    {

        $sum_of_approved_payments = PaymentService::sumOfApprovedPaymentsPerUser();

        return response()->json(
            [
                'approved_payments' => $sum_of_approved_payments
            ],
            200
        );
    }
}
