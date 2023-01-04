<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelPayment>
 */
class TravelPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Payment::all()->random(),
            'user_id' => User::all()->random(),
            'amount' => fake()->randomNumber([1000, 9999]),
            'created_at' => now(),
        ];
    }
}
