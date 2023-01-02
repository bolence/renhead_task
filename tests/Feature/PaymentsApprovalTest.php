<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsApprovalTest extends TestCase
{
    use RefreshDatabase;

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

        $payment = Payment::factory()->create();

        $approval = [
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'payment_type' => 'credit',
            'status' => 'APPROVED'
        ];

        $this->json('POST', '/api/payments_approval', $approval)->assertStatus(200);
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

        $payment = Payment::factory()->create();

        $approval = [
            'payment_id' => $payment->id,
            'user_id' => $user->id,
            'payment_type' => 'credit',
            'status' => 'APPROVED'
        ];

        $this->json('POST', '/api/payments_approval', $approval)->assertStatus(400);
    }
}
