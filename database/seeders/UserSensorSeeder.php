<?php

namespace Database\Seeders;

use App\Models\SmartPhoneSensor;
use App\Models\SmartWatchSensor;
use App\Models\User;
use App\Models\UserSensor;
use App\Utils\CsvSensors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class UserSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new CsvSensors)->import();
    }

}
