<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), 
            'user_type'=>'Admin',
            'phone'=> '9808363631',
            'address'=> 'gwarko',
        ]);

        // Assign the 'admin' role to the user
        $adminUser->assignRole('Admin');

        
    }
}
