<?php

namespace App\Services;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentService extends GlobalService
{

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
            return $this->unsuccessful_response('Error during saving a new payment', $th);
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
            return $this->unsuccessful_response('Unable to update a payment', $th);
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
            return $this->unsuccessful_response('Error during deleting a payment', $th);
        }

        return $this->success_response('Successfully deleted a payment', ['payment' => $cloned_payment]);
    }


    /**
     * Get sum of approved payments per user who is approver
     *
     * @return array
     */
    public static function sumOfApprovedPaymentsPerUser()
    {
        $approved_payments_sum = [];

        $sum_of_approved_payments_query = DB::table('payments as p')
            ->selectRaw('p.total_amount, pa.user_id, p.id as payment_id')
            ->join('payment_approvals as pa', 'p.id', '=', 'pa.payment_id')
            ->join('users as u', 'pa.user_id', '=', 'u.id')
            ->where('u.type', 'APPROVER')
            ->where('pa.status', 'APPROVED')
            ->groupBy('p.id')
            ->havingRaw('count(status) = (SELECT count(id) from users where type = "APPROVER")')
            ->get();

        $collection = collect($sum_of_approved_payments_query);

        $sum_of_approved_payments = $collection->sum('total_amount');

        $payments_id = $collection->pluck('payment_id');

        $payments = Payment::with('travel_payments')->whereIn('id', $payments_id)->get();

        foreach (User::approvers() as $approver) {
            $approved_payments_sum[] = [
                'name' => $approver->full_name,
                'sum_of_approved_payments' => (int) $sum_of_approved_payments,
                'payments' => $payments,
            ];
        }

        return $approved_payments_sum;
    }
}
