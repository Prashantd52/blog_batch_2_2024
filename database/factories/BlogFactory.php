<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title'=>$this->faker->sentence,
            'content'=>$this->faker->paragraph,
            'slug'=>$this->faker->slug,
            'cover_image'=>$this->faker->imageUrl(),
            'category_id'=>$this->faker->numberBetween(1,10),
            'user_id'=>$this->faker->numberBetween(1,11),
        ];
    }
}
