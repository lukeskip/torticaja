<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'cheko', 'email'=> 'contacto@chekogarcia.com.mx','password' => bcrypt('botargaB5'),'role'=>'admin','branch_id'=>null],
            ['name'=>'cheko', 'email'=> 'employee@chekogarcia.com.mx','password' => bcrypt('botargaB5'),'role'=>'employee','branch_id'=>3],
        ];
        
        User::insert($users);

        User::factory()->count(40)->create();  
    }
}
