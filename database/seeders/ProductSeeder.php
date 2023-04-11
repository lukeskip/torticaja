<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Branch;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $branches = Branch::all();
        foreach ($branches as $branch) {
            Product::factory()->count(30)->create(['store_id'=>$branch->stores->id,'branch_id'=>$branch->id]);        
        }
    }
}

