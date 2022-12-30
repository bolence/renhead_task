<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentApproval>
 */
class PaymentApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(),
            'payment_id' => Payment::all()->random(),
            'payment_type' => 'bank',
            'status' => fake()->randomElement(['APPROVED', 'DISAPPROVED']),
            'created_at' => now()
        ];
    }
}
