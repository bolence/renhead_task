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

    protected $user;

    protected $payment;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->payment = Payment::factory()->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_payments()
    {

        Sanctum::actingAs(User::factory()->create());

        $this->json('GET', '/api/payments')
            ->assertStatus(200)
            ->assertJsonStructure(['payments' => [
                '*' => [
                'id',
                'user_id',
                'total_amount'
                ]
            ]
        ]);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_user_cant_see_payments()
    {
        $this->json('GET', '/api/payments')->assertStatus(401);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_user_can_create_a_new_payment()
    {

        Sanctum::actingAs(User::factory()->create());

        $payment = [
            'user_id' => $this->user->id,
            'total_amount' => 1000
        ];

        $this->json('POST', '/api/payments', $payment)->assertStatus(200);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function test_user_can_update_a_payment()
    {
        Sanctum::actingAs(User::factory()->create());

        $new_payment_data = [
            'user_id' => $this->user->id,
            'total_amount' => 1000
        ];

        $this->json('PUT', "/api/payments/{$this->payment->id}", $new_payment_data)->assertStatus(200);
    }

    public function test_user_can_delete_a_payment()
    {
        Sanctum::actingAs(User::factory()->create());

        $this->json('DELETE', "/api/payments/{$this->payment->id}")->assertStatus(200);
    }
}
