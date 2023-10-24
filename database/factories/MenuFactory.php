<?php

namespace Database\Factories;

use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use FakerRestaurant\Provider\id_ID\Restaurant as RestaurantFaker;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Add the FakerRestaurant provider to the Faker generator
        $this->faker->addProvider(new Restaurant($this->faker));

        return [
            'name' => $this->faker->foodName(),
            'price' => $this->faker->randomFloat(2, 5000, 20000),
            'description' => $this->faker->sentence(mt_rand(5, 15)),
            'photo' => "null.jpg"
        ];
    }
}
