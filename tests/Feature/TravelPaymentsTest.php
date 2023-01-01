<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Laravel\Sanctum\Sanctum;
use App\Models\TravelPayment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelPaymentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_travel_payments()
    {
        Sanctum::actingAs(User::factory()->create());

        $this->json('GET','/api/travel_payments')->assertStatus(200);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_user_can_save_new_travel_payments()
    {
        // Sanctum::actingAs(User::factory()->create());

        // $payment = Payment::factory()->create();

        // $travel_payment = [
        //     'id' => $payment->id,
        //     'user_id' => $payment->user->id,
        //     'amount' => 2000,
        // ];

        // $this->json('POST', '/api/travel_payments', $travel_payment)->assertStatus(200);
    }


    //     /**
    //  * Undocumented function
    //  *
    //  * @return void
    //  */
    // public function test_user_can_update_a_travel_payment()
    // {
    //     Sanctum::actingAs(User::factory()->create());

    //     $new_travel_payment_data = [
    //         'user_id' => $this->user->id,
    //         'total_amount' => 1000
    //     ];

    //     $this->json('PUT', "/api/payments/{$this->travel_payment->id}", $new_travel_payment_data)->assertStatus(200);
    // }
}
