<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->sentence(2),
            'address'=>$this->faker->sentence(5),
            'phone'=>$this->faker->phoneNumber,
            'store_id'=>Store::inRandomOrder()->first()->id,
        ];
    }
}
