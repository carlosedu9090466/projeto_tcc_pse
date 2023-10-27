<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'adm',
            'email' => 'adm@adm.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$ZG7nkdR5HqXDIM80w7c63ePQ25cEWmEatV9HvQtg5NqLSibzY4ryC', // password
            'remember_token' => Str::random(10),
            'role_id' => 1
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
