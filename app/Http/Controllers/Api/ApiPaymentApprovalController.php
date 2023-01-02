<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentApprovalRequest;
use App\Services\PaymentApprovalService;


class ApiPaymentApprovalController extends Controller
{

    protected PaymentApprovalService $payment_approval;

    /**
     * Class constructor
     *
     * @param PaymentApprovalService $payment_approval
     */
    public function __construct(PaymentApprovalService $payment_approval)
    {
        $this->payment_approval = $payment_approval;
    }

    /**
     * Approve payment by approver user
     *
     * @param PaymentApprovalRequest $request
     * @return void
     */
    public function store(PaymentApprovalRequest $request)
    {
        return $this->payment_approval->approve($request);
    }
}
