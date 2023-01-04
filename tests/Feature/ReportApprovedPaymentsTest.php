<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Laravel\Sanctum\Sanctum;
use App\Models\PaymentApproval;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportApprovedPaymentsTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test report of approved payments
     *
     * @return void
     */
    public function test_report_for_approved_payments_per_user()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $payment = Payment::factory()->create();

        PaymentApproval::factory()->create([
            "payment_id" => $payment->id,
            "user_id" => $user->id,
            "status" => "APPROVED",
            "payment_type" => "App\Models\Payment",
        ]);

        $this->json('GET', '/api/approved_payments/reports')->assertStatus(200);
    }
}
