<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $name = $firstName . " " . $lastName;

        return [
            'nick' => $this->faker->unique()->word,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make("12345678"), // password
            'role'=> 'user',
            'fullname' => $name, 
            'remember_token' => Str::random(10),
            'avatar' =>"imagendefault.png"
        ];
    }
}
