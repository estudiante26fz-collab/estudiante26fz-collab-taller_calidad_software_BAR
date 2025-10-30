<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;    
use Illuminate\Support\Facades\Hash;


class RolesAndUsersSeeder extends Seeder
{
  
    public function run()
    {
        
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleClient = Role::firstOrCreate(['name' => 'client']);

        User::Create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ])->assignRole($roleAdmin);

        User::Create([
            'name' => 'Client User',
            'email' => 'client@gmail.com',
            'password' => Hash::make('1234'),
        ])->assignRole($roleClient);
    }
}