<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Store;

class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $store = Store::inRandomOrder()->first();

        if($store->branches){
            $branch = $store->branches->first();
        }else{
            $branch = null;
        }

        return [
            'amount'    => $this->faker->randomDigit,
            'store_id'  => $store->id,
            'branch_id' => $branch,
        ];
    }
}
