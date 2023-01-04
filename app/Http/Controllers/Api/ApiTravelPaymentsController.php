<?php

namespace App\Http\Controllers\Api;

use App\Services\TravelPaymentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelPaymentRequest;

class ApiTravelPaymentsController extends Controller
{

    protected TravelPaymentService $travelPayment;

    /**
     * Class constructor
     *
     * @param TravelPaymentService $travelPayment
     */
    public function __construct(TravelPaymentService $travelPayment)
    {
        $this->travelPayment = $travelPayment;
    }
    /**
     * Show all travel payments
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->travelPayment->getAllTravelPayments();
    }

    /**
     * Store new travel payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPaymentRequest $request)
    {
        return $this->travelPayment->saveTravelPayment($request->validated());
    }

    /**
     * Show travel payment with specific id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->travelPayment->showTravelPayment($id);
    }

    /**
     * Update travel payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->travelPayment->updateTravelPayment($request->validated(), $id);
    }

    /**
     * Delete travel payment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->travelPayment->deleteTravelPayment($id);
    }
}
