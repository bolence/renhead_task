<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginAuthenticationTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_has_requested_a_authentication_token()
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);
    }
}
