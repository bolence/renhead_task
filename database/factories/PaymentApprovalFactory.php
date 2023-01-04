<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\PaymentApproval;
use App\Models\TravelPayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentApproval>
 */
class PaymentApprovalFactory extends Factory
{

    protected $model = PaymentApproval::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $payment = $this->payment();

        return [
            'user_id' => User::all()->random(),
            'payment_id' => $payment::factory(),
            'payment_type' => $payment,
            'status' => fake()->randomElement(['APPROVED', 'DISAPPROVED']),
            'created_at' => now()
        ];
    }


    public function payment()
    {
        return fake()->randomElement([
            Payment::class,
            TravelPayment::class,
        ]);
    }
}
