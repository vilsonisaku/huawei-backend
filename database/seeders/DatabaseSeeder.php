<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(DeviceTypeSeeder::class);
        // $this->call(UserSeeder::class);
        
        // \App\Models\User::factory(10)->create();


        $this->call(UserSensorSeeder::class);
    }
}
