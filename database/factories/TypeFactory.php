<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typearray = ["Mie", "Nasi", "Kue", "Es Krim", "Sate", "Puding", "Teh", "Kopi"];
        return [
            'name' => $this->faker->randomElement($typearray)
        ];
    }
}
