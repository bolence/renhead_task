<?php

namespace App\Services;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class ApprovedPaymentReportService
{

    /**
     * Get sum of approved payments per user who is approver
     *
     * @return array
     */
    public function sum_of_approved_payments()
    {
        $approved_payments_sum = [];

        $sum_of_approved_payments_query = DB::table('payments as p')
            ->selectRaw('p.total_amount, p.id as payment_id')
            ->join('payment_approvals as pa', 'p.id', '=', 'pa.payment_id')
            ->join('users as u', 'pa.user_id', '=', 'u.id')
            ->where('u.type', 'APPROVER')
            ->where('pa.status', 'APPROVED')
            ->groupBy('p.id')
            ->havingRaw('COUNT(status) = (SELECT count(id) FROM users WHERE type = "APPROVER")')
            ->get();


        $sum_of_approved_payments = $sum_of_approved_payments_query->sum('total_amount');

        $payments_id = $sum_of_approved_payments_query->pluck('payment_id');

        $payments = Payment::whereIn('id', $payments_id)->get();

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
