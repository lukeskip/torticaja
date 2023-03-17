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
        $store = Store::all()->random();
        return [
            'label' => $this->faker->sentence(2),
            'price' => $this->faker->unique()->safeEmail(),
            'unit' => now(),
            'branch_id'=>$store->branches()->random(),
            'store_id'=>$store,
        ];

    }
}
