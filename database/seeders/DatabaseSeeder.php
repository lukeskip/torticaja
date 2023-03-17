<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;
use App\Models\User;
use App\Models\Ingredient;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            ['label'=>'kg_price', 'value'=> 18],
            ['label'=>'membership_max', 'value'=>30],
            ['label'=>'membership_kg_price', 'value'=>15],
            ['label'=>'dough_ratio', 'value'=>1.8],
            ['label'=>'min_ingredient', 'value'=>5],
        ];
        
        Config::insert($configs);

        $users = [
            ['name'=>'cheko', 'email'=> 'contacto@chekogarcia.com.mx','password' => bcrypt('botargaB5'),'role'=>'admin'],
            ['name'=>'encargado', 'email'=> 'encargado@lanueva.com.mx','password' => bcrypt('LaNu3va250!$'),'role' => 'employee']
        ];
        
        User::insert($users);
        


    }
}
