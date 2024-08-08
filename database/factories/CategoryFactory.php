<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = new Faker;
        return [
            'name'=>$this->faker->word,
            'slug'=>$this->faker->slug,
            'description'=>$this->faker->sentence,
            'image'=>$this->faker->imageUrl()
        ];
    }
}
