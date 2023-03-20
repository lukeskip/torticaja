<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store; 

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $store = Store::inRandomOrder()->first();
        return [
            'label' => $this->faker->sentence(2),
            'price' => $this->faker->randomFloat(2,10,50),
            'unit' => now(),
            'branch_id'=>$store->branches()->inRandomOrder()->first()->id,
            'store_id'=>$store->id,
        ];

    }
}
