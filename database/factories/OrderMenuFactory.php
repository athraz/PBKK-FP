<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderMenu>
 */
class OrderMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_id' => $id = mt_rand(1, 16),
            'quantity' => mt_rand(1, 5),
            'order_price' => Menu::findOrFail($id)->price
        ];
    }
}
