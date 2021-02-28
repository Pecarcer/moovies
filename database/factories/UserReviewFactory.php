<?php

namespace Database\Factories;
use App\Models\Review;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,User::count()),
            'review_id'=> $this->faker->numberBetween(1,Review::count()),
        ];
    }
}
