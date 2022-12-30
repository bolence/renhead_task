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
     * Undocumented function
     *
     * @param TravelPaymentService $travelPayment
     */
    public function __construct(TravelPaymentService $travelPayment)
    {
        $this->travelPayment = $travelPayment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->travelPayment->getAllTravelPayments();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPaymentRequest $request)
    {
        return $this->travelPayment->saveTravelPayment($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->travelPayment->showTravelPayment($id);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
