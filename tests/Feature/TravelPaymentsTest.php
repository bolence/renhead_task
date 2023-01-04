<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use App\Models\TravelPayment;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelPaymentsTest extends TestCase
{
    use RefreshDatabase;

    protected $travel_payment;

    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(User::factory()->create());
        $this->travel_payment = TravelPayment::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_travel_payments()
    {
        $this->getJson('/api/travel_payments')->assertStatus(200);
    }

    /**
     * Test if user can create a new travel payment
     *
     * @return void
     */
    public function test_user_can_create_new_travel_payments()
    {
        $this->postJson('/api/travel_payments', $this->travel_payment->toArray())->assertStatus(200);
    }

    /**
     * Test if user can see specific travel payment
     *
     * @return void
     */
    public function test_user_can_see_specific_travel_payment()
    {
        $this->getJson("/api/travel_payments/{$this->travel_payment->id}")->assertStatus(200);
    }

    /**
     * Test if user can update a existing travel
     *
     * @return void
     */
    public function test_user_can_update_a_travel_payment()
    {
        $this->travel_payment->amount = 2000;

        $this->putJson("/api/travel_payments/{$this->travel_payment->id}", $this->travel_payment->toArray())->assertStatus(200);
    }

    /**
     * Test if user can delete a travel payment
     *
     * @return void
     */
    public function test_user_can_delete_travel_payment()
    {
        $this->deleteJson("/api/travel_payments/{$this->travel_payment->id}")->assertStatus(200);
    }
}
