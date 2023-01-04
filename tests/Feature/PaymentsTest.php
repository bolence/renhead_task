<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsTest extends TestCase
{
    use RefreshDatabase;

    protected $payment;

    public function setUp(): void
    {
        parent::setUp();
        User::factory(3)->create();
        $this->payment = Payment::factory()->create();
    }

    /**
     * Test if user can see a payments
     *
     * @return void
     */
    public function test_user_can_see_payments()
    {

        Sanctum::actingAs(User::factory()->create());

        $this->json('GET', '/api/payments')
            ->assertStatus(200)
            ->assertJsonStructure([
                'payments' => [
                    '*' => [
                        'id',
                        'user_id',
                        'total_amount'
                    ]
                ]
            ]);
    }

    /**
     * Test if user cant see a payments
     *
     * @return void
     */
    public function test_user_cant_see_payments()
    {
        $this->getJson('/api/payments')->assertStatus(401);
    }

    /**
     * Test if user can see specific payment
     *
     * @return void
     */
    public function test_user_can_see_specific_payment()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->getJson("/api/payments/{$this->payment->id}")->assertStatus(200);
    }

    /**
     * Test if user can create a new payment
     *
     * @return void
     */
    public function test_user_can_create_a_new_payment()
    {

        $user = Sanctum::actingAs(User::factory()->create());

        $payment = [
            'user_id' => $user->id,
            'total_amount' => 1000
        ];

        $this->postJson('/api/payments', $payment)->assertStatus(200);
    }

    /**
     * Test if user can update a payment
     *
     * @return void
     */
    public function test_user_can_update_a_payment()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $new_payment_data = [
            'user_id' => $user->id,
            'total_amount' => 1000
        ];

        $this->putJson("/api/payments/{$this->payment->id}", $new_payment_data)->assertStatus(200);
    }

    /**
     * Test if user can delete a payment
     *
     * @return void
     */
    public function test_user_can_delete_a_payment()
    {
        Sanctum::actingAs(User::factory()->create());

        $payment = Payment::first();

        $this->deleteJson("/api/payments/{$payment->id}")->assertStatus(200);
    }
}
