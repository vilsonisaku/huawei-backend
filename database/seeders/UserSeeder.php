<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            "name"=>"admin"
        ]);

        $userRole = Role::create([
            "name"=>"user"
        ]);

        User::make([
            'first_name' => 'test',
            'last_name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('test123'),
        ])->role()->associate($userRole->id)->save();


        User::make([
            'first_name' => 'renis',
            'last_name' => 'test',
            'email' => 'renis@gmail.com',
            'password' => bcrypt('test123'),
        ])->role()->associate($userRole->id)->save();

        User::make([
            'first_name' => 'vilson',
            'last_name' => 'test',
            'email' => 'vilson@gmail.com',
            'password' => bcrypt('test123'),
        ])->role()->associate($userRole->id)->save();

        User::make([
            'first_name' => 'ariel',
            'last_name' => 'test',
            'email' => 'ariel@gmail.com',
            'password' => bcrypt('test123'),
        ])->role()->associate($userRole->id)->save();
    }
}
