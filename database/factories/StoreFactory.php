<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'name'=>$this->faker->sentence(2),
            'address'=>$this->faker->sentence(5),
            'phone'=>$this->faker->phoneNumber,
            'user_id'=>$user->id,
        ];

    }
}
