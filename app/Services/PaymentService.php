<?php namespace App\Services;

use App\Models\Payment;

class PaymentService extends GlobalService {

    /**
     * Get all payments
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPayments()
    {
        return $this->success_response(null, ['payments' => Payment::all()]);
    }

    /**
     * Save new payment
     *
     * @param array $request
     * @return \Illuminate\Http\Response
     */
    public function savePayment(array $request)
    {

        try {
            $payment = Payment::create($request);
        } catch (\Throwable $th) {
            return $this->unsuccessful_reponse('Error during saving a new payment', $th);
        }

        return $this->success_response('Successfully created a new payment', ['payment' => $payment]);

    }

    /**
     * Show single payment
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showPayment(int $id)
    {
        return $this->success_response(null, ['payment' =>  Payment::findOrFail($id)]);
    }

    /**
     * Update payment
     *
     * @param array $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function updatePayment(array $request, int $id)
    {

        $payment = Payment::findOrFail($id);

        try {
            $payment->update($request);
        } catch (\Throwable $th) {
            return $this->unsuccessful_reponse('Unable to update a payment', $th);
        }

        return $this->success_response('Successfully updated a payment', ['payment' => $payment]);
    }

    /**
     * Delete payment
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function deletePayment(int $id)
    {
        $payment = Payment::findOrFail($id);
        $cloned_payment = $payment->replicate();

        try {
            $payment->delete();
        } catch (\Throwable $th) {
            return $this->unsuccessful_reponse('Error during deleting a payment', $th);
        }

        return $this->success_response('Successfully deleted a payment', ['payment' => $cloned_payment]);
    }

}
