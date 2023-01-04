<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsApprovalTest extends TestCase
{
    use RefreshDatabase;

    protected $payment;

    public function setUp(): void
    {
        parent::setUp();
        $this->payment = Payment::factory()->create();
    }

    /**
     * Test if user who is approver can approve a payment
     *
     * @return void
     */
    public function test_user_can_approve_payments()
    {
        $user = Sanctum::actingAs(User::factory()->create([
            'type' => 'APPROVER'
        ]));

        $approval = [
            'payment_id' => $this->payment->id,
            'user_id' => $user->id,
            'status' => 'APPROVED'
        ];

        $this->postJson('/api/payments_approval', $approval)->assertStatus(200)->dump();
    }

    /**
     * Test if user who is not approver can approve a payment
     *
     * @return void
     */
    public function test_user_can_not_approver_payments()
    {
        $user = Sanctum::actingAs(User::factory()->create([
            'type' => 'BASIC'
        ]));

        $approval = [
            'payment_id' => $this->payment->id,
            'user_id' => $user->id,
            'status' => 'APPROVED'
        ];

        $this->json('POST', '/api/payments_approval', $approval)->assertStatus(400);
    }
}
