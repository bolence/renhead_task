<?php namespace App\Services;

use App\Models\TravelPayment;

class TravelPaymentService extends GlobalService {

    public function getAllTravelPayments()
    {
        return response()->json([
            'travel_payments' => TravelPayment::all()
        ], 200);
    }

    public function saveTravelPayment(array $request)
    {

        try {
            $travel_payment = TravelPayment::create($request);
        } catch (\Throwable $th) {
            return $this->unsuccessful_reponse('Error during saving a travel payments', $th);
        }

        return $this->success_response('Successfully saved a new travel payment', ['travel_payment' => $travel_payment]);
    }


    public function updateTravelPayment(array $request, int $id)
    {
        $travel_payment = TravelPayment::findOrFail($id);

        try {
            $travel_payment->update($request);
        } catch (\Throwable $th) {
            return $this->unsuccessful_reponse('Error during updating a travel payments', [], $th);
        }

        return $this->success_response('Successfully updated a travel payments', ['travel_payment' => $travel_payment]);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function showTravelPayment(int $id)
    {
        $travel_payment = TravelPayment::findOrFail($id);

        return $this->success_response(null, ['travel_payment' => $travel_payment]);
    }

}
