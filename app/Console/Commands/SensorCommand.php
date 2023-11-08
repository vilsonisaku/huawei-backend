<?php

namespace App\Console\Commands;

use App\Models\Sensor;
use App\Models\SmartPhoneSensor;
use App\Models\SmartWatchSensor;
use App\Models\User;
use App\Utils\CsvSensors;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SensorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:sensors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new CsvSensors)->import();
    }
    
}
