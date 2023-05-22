<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cadastral_number' => $this->faker->swiftBicNumber,
            'address' => $this->faker->address,
            'area' => $this->faker->randomFloat(9999999, 100000),
            'price' => $this->faker->randomFloat(9999999, 100000)
        ];
    }
}
