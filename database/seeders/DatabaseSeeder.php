<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{
    Payment,
    PaymentApproval,
    User
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Payment::truncate();

        PaymentApproval::truncate();
        User::factory(2)->create()->each(function ($user) {
            $payments = Payment::factory(200)->make();
            $user->payments()->saveMany($payments);
        });

        PaymentApproval::factory(200)->create();
        Schema::enableForeignKeyConstraints();
    }
}
