<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'score' => $this->faker->randomDigit,
            'opinion' => $this->faker->sentence(10),
            'user_id' => $this->faker->numberBetween(1,User::count()),
            'movie_id'=> $this->faker->numberBetween(1,Movie::count()),
        ];
    }
}
