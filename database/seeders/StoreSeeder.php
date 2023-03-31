<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models;
use App\Models\Store;
use App\Models\User;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role','admin')->get();
        foreach($users as $user){
            Store::factory()->create(['user_id'=>$user->id]); 
        }
    }
}
