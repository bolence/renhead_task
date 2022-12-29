<?php

namespace App\Http\Controllers\Api;

use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;

class ApiPaymentsController extends Controller
{

    protected PaymentService $paymentService;

    /**
     * Class constructor
     *
     * @param PaymentService $paymentService
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    /**
     * Get all payments
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->paymentService->getAllPayments();
    }

    /**
     * Save newly payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        return $this->paymentService->savePayment($request->validated());
    }

    /**
     * Show single payment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->paymentService->showPayment($id);
    }

    /**
     * Update a payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, $id)
    {
        return $this->paymentService->updatePayment($request->validated(), $id);
    }

    /**
     * Delete a payment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->paymentService->deletePayment($id);
    }
}
