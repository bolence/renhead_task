<?php

namespace App\Services;

use App\Models\TravelPayment;
use App\Services\GlobalService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class TravelPaymentService extends GlobalService
{

    /**
     * Get all travel payments
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTravelPayments()
    {
        return response()->json([
            'travel_payments' => TravelPayment::all()
        ], 200);
    }

    /**
     * Save travel payments
     *
     * @param array $request
     * @return \Illuminate\Http\Response
     */
    public function saveTravelPayment(array $request)
    {

        try {
            $travel_payment = TravelPayment::create($request);
        } catch (\Throwable $th) {
            return $this->unsuccessful_response('Error during saving a travel payments', $th);
        }

        return $this->success_response('Successfully saved a new travel payment', ['travel_payment' => $travel_payment]);
    }

    /**
     * Show single travel payments
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showTravelPayment(int $id)
    {
        return $this->success_response(null, ['travel_payment' => TravelPayment::findOrFail($id)]);
    }

    /**
     * Update travel payments
     *
     * @param array $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function updateTravelPayment(array $request, int $id)
    {
        $travel_payment = TravelPayment::findOrFail($id);

        // this can be moved to Laravel policies classes
        if ($travel_payment->user_id !== $request['user_id']) {
            throw new AuthenticationException('You are not allowed to update this travel payment');
        }

        try {
            $travel_payment->update($request);
        } catch (\Throwable $th) {
            return $this->unsuccessful_response('Error during updating a travel payments', $th);
        }

        return $this->success_response('Successfully updated a travel payments', ['travel_payment' => $travel_payment]);
    }

    /**
     * Delete travel payment
     *
     * @param array $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTravelPayment(int $id)
    {
        $travel_payment = TravelPayment::findOrFail($id);
        // this can be moved to Laravel policies classes
        if ($travel_payment->user_id !== Auth::id()) {
            throw new AuthenticationException('You are not allowed to delete this travel payment');
        }
        $travel_payment_clone = $travel_payment->clone();

        try {
            $travel_payment->delete();
        } catch (\Throwable $th) {
            return $this->unsuccessful_response('Error during updating a travel payments', $th);
        }

        return $this->success_response('Successfully delete a travel payment', ['travel_payment' => $travel_payment_clone]);
    }
}
