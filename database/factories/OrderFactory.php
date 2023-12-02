<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => mt_rand(2, 11),
            'total_price' => 0,
            'payment_method' => $this->faker->randomElement(['Cash', 'Transfer Bank', 'E-Wallet']),
            'address' => $this->faker->address,
            'status' => 'Waiting',
            'employee_id' => mt_rand(2, 11)
        ];
    }
}