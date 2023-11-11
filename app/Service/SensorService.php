<?php

namespace App\Service;

use App\Http\Requests\GetUserSensorRequest;
use App\Http\Requests\Request;
use App\Models\Role;
use App\Models\SensorType;
use App\Models\User;
use App\Models\UserSensor;
use Faker\Core\Number;

class SensorService 
{
    function __construct(protected SensorType $sensorType,protected UserSensor $userSensor){

    }

    function getSensorTypes(){
        return $this->sensorType->paginate(10);
    }

    function getUserSensors(string $name,$take){
        $sensor = $this->sensorType->whereName($name)->first();
        return $this->userSensor->where("type_id",$sensor->id)->with("type")->latest('created_at')->paginate($take);
    }

    function updateUserSensor(string $name){
        $sensor = $this->sensorType->whereName($name)->first();
    }

}