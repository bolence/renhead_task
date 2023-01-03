<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
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
        Sanctum::actingAs(User::factory()->create());
        $this->json('GET', '/api/approved_payments/reports')->assertStatus(200);
    }
}
