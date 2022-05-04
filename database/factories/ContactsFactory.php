<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Image;

class ContactsFactory extends Factory
{

   

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $filePath = public_path('img');
        return [
            'nom' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'prenom' => $this->faker->firstName(),
            'image_url' => $this->faker->imageUrl($width=100, $height=100, null, false )
        ];
    }
}
