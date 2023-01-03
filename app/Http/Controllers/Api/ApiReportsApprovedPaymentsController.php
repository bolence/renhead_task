<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApprovedPaymentService;

class ApiReportsApprovedPaymentsController extends Controller
{
    protected ApprovedPaymentService $approverPaymentService;

    public function __construct(ApprovedPaymentService $approverPaymentService)
    {
        $this->approverPaymentService = $approverPaymentService;
    }
    /**
     * Sum of approved payments for every approver
     *
     * @return void
     */
    public function index()
    {

        $sum_of_approved_payments = $this->approverPaymentService->sum_of_approved_payments();

        return response()->json(
            [
                'approved_payments' => $sum_of_approved_payments
            ],
            200
        );
    }
}
