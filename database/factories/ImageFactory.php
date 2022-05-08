<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => 'images/default-avatar.jpg',
            'contact_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
