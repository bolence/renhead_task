<?php namespace App\Services;

use App\Models\Payment;

class PaymentService extends GlobalService {

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAllPayments()
    {
        return response()->json([
            'payments' => Payment::all()
        ], 200);
    }

    /**
     * Undocumented function
     *
     * @param array $request
     * @return void
     */
    public function savePayment(array $request)
    {
        try {
            $payment = Payment::create($request);
        } catch (\Throwable $th) {
            info('Error during saving a new payment ' . $th->getMessage() . ' ' . $th->getLine() . ' ' . $th->getCode());
            return response()->json([
                'message' => 'Unable to save a new payment'
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully created a new payment',
            'payment' => $payment
        ], 200);

    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function showPayment(int $id)
    {
        return response()->json(['payment' => Payment::findOrFail($id)]);
    }

    /**
     * Undocumented function
     *
     * @param array $request
     * @param integer $id
     * @return void
     */
    public function updatePayment(array $request, int $id)
    {

        $payment = Payment::findOrFail($id);

        try {
            $payment->update($request);
        } catch (\Throwable $th) {
            info('Error during updating a payment ' . $th->getMessage() . ' ' . $th->getLine() . ' ' . $th->getCode());
            return response()->json([
                'message' => 'Unable to update a payment'
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully updated a payment',
            'payment' => $payment
        ], 200);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function deletePayment(int $id)
    {
        $payment = Payment::findOrFail($id);

        try {
            $payment->delete();
        } catch (\Throwable $th) {
            info('Error during deleting a payment ' . $th->getMessage() . ' ' . $th->getLine() . ' ' . $th->getCode());
            return response()->json([
                'message' => 'Unable to delete a payment'
            ], 400);
        }

        return response()->json([
            'message' => 'Successfully deleted a payment'
        ], 200);
    }

}
