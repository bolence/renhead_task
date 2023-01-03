<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
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

        $this->json('GET', '/api/travel_payments')->assertStatus(200);
    }
}
