<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jenis>
 */
class JenisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ArrayJenis = ["Mie", "Nasi", "Kue", "Es Krim", "Sate", "Puding", "Teh", "Kopi"];
        return [
            'nama' => $this->faker->randomElement($ArrayJenis)
        ];
    }
}
