<?php

namespace App\Utils;

use App\Models\Role;
use App\Models\SmartPhoneSensor;
use App\Models\SmartWatchSensor;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CsvSensors 
{
    protected User $user;
    
    /*
    *   import csv data into db
    */
    public function import()
    {
        ini_set("memory_limit",-1);

        $this->user = User::first();

        $this->saveSmartPhoneSensors();
        $this->saveSmartWatchSensors();

    }
    


    function saveSmartPhoneSensors(){
        $sensors = Storage::get("smartphone.csv");
        $data = $this->filterSensorTypes($sensors);
        SmartPhoneSensor::insertOrIgnore( $data->toArray() );

        $data = $this->saveSensorsValues($sensors);
    }

    function saveSmartWatchSensors(){
        $sensors = Storage::get("smartwatch.csv");
        $data = $this->filterSensorTypes($sensors);
        SmartWatchSensor::insertOrIgnore( $data->toArray() );
    }


    /*
    *   filter string row of csv
    */
    function filterSensorValues(string $row) : array {
        if(!isset(explode("[",$row)[1])){
            echo $row;
        }
        return [ 
            "type"=>explode(",",$row)[1] , 
            "value"=>explode(", ", 
                str_replace("'","", 
                    explode("]",
                        explode("[",$row)[1]
                    )[0]
                )
            ) 
        ];
    }

    /*
    *   save sensor values into db
    */
    function saveSensorsValues(string $sensors){
        $sensors = explode("\n",$sensors);

        array_shift($sensors);
        $types = SmartPhoneSensor::get();
        return collect($sensors)->map(function($row) use ($types){ 
            $data = $this->filterSensorValues($row);
            $type = $types->where("name",$data["type"])->first();
            $this->user->sensors()->make(["value"=>json_encode($data["value"]) ])->type()->associate($type)->save();
        });
    }

    /*
    *   filter sensor types to get the unique names
    */
    function filterSensorTypes(string $sensors){
        $sensors = explode("\n",$sensors);
        array_shift($sensors);

        $data = collect($sensors)->map(function($row){ 
            $item = explode(",",$row); 
            return $item[1];
        })->unique()->values()->map(function($sensor_name){
            return ["name"=>$sensor_name];
        });

        return $data;
    }

}