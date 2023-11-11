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

    function getUserSensors(User $user, string $name,$take){
        $sensor = $this->sensorType->whereName($name)->firstOrFail();
        return $this->userSensor->where("type_id",$sensor->id)->where("user_id",$user->id)->with("type")->latest('created_at')->paginate($take);
    }

    function updateUserSensors(User $user, string $name,array $data){
        $sensor = $this->sensorType->whereName($name)->firstOrFail();
        foreach($data as $key => $valueTime){
            $data[$key]["type_id"]=$sensor->id;
            $data[$key]["user_id"]=$user->id;
            $data[$key]["value"] = json_encode($data[$key]["value"]);
        }
        return $this->userSensor->upsert($data,"id");
    }

}