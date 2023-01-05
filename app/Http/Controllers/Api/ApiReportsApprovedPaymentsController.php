<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Services\ApprovedPaymentReportService;

class ApiReportsApprovedPaymentsController extends Controller
{
    protected ApprovedPaymentReportService $approverPaymentService;

    public function __construct(ApprovedPaymentReportService $approverPaymentService)
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
