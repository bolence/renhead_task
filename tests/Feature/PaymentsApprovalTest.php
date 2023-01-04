<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Laravel\Sanctum\Sanctum;
use App\Models\TravelPayment;
use App\Models\PaymentApproval;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsApprovalTest extends TestCase
{
    use RefreshDatabase;

    protected $payment;

    public function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
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

        $payment_approval = PaymentApproval::factory()->create([
            "payment_id" => $this->payment->id,
            "user_id" => $user->id,
            "status" => "APPROVED",
            "payment_type" => "App\Models\Payment",
        ]);

        $this->postJson('/api/payments_approval', $payment_approval->toArray())->assertStatus(200);
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

        $travel_payment = TravelPayment::factory()->create();

        $payment_approval = PaymentApproval::factory()->create([
            "payment_id" => $travel_payment->id,
            "user_id" => $user->id,
            "status" => "APPROVED",
            "payment_type" => "App\Models\TravelPayment",
        ]);

        $this->json('POST', '/api/payments_approval', $payment_approval->toArray())->assertStatus(400);
    }
}
