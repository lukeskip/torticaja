<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Store;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = Store::all();
        foreach($stores as $store){
            Branch::factory()->count(3)->create(['store_id'=>$store->id]);  
        }
    }
}
