<?php

namespace App\Services;

use App\Models\PaymentApproval;


class PaymentApprovalService extends GlobalService
{

    /**
     * Approve payment
     *
     * @param Object $request
     * @return Illuminate\Http\Response
     */
    public function approve($request)
    {
        if (!auth()->user()->approver()) {
            return $this->unsuccessful_response('You don\'t have proper permission to approve payment');
        }

        $payment_approve = PaymentApproval::create($request);

        return $this->success_response('Successfully approved a payment', ['payment_approved' => $payment_approve->with('payment')->first()]);
    }
}
