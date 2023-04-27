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
        $units = ['piece','kg'];
        $label = $this->faker->sentence(2);
        return [
            'label' => $label,
            'slug' => \Str::slug($label),
            'price' => $this->faker->randomFloat(2,10,50),
            // 'unit' => $units[array_rand($units)],
            'unit' => 'piece',
            
        ];

    }
}
