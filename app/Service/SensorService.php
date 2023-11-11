<?php

namespace App\Service;

use App\Http\Requests\GetUserSensorRequest;
use App\Http\Requests\Request;
use App\Models\Role;
use App\Models\SensorType;
use App\Models\User;
use App\Models\UserSensor;
use Faker\Core\Number;
use Illuminate\Support\Facades\DB;

class SensorService 
{
    function __construct(protected SensorType $sensorType,protected UserSensor $userSensor){

    }

    function findSensorTypeByName(string $name){
        return $this->sensorType->whereName($name)->firstOrFail();
    }

    function getSensorTypes(){
        return $this->sensorType->paginate(10);
    }

    function getUserSensors(User $user, string $name,$take){
        $sensor = $this->findSensorTypeByName($name);
        return $this->userSensor->where("type_id",$sensor->id)->where("user_id",$user->id)->with("type")->latest('created_at')->paginate($take);
    }

    function updateUserSensors(User $user, string $name,array $data){
        $sensor = $this->findSensorTypeByName($name);
        foreach($data as $key => $valueTime){
            $data[$key]["type_id"]=$sensor->id;
            $data[$key]["user_id"]=$user->id;
            $data[$key]["value"] = json_encode($data[$key]["value"]);
        }
        return $this->userSensor->upsert($data,"id");
    }

    
    function getProfileInfo(User $user){
        $steps = $this->getStepsCount($user);

        return [
            "steps"=>$steps,
            "heard_rate"=> $this->getUserHeardRates($user),
            "sleep"=> "7h 32min",
            "calories"=> 4300,
        ];
    }

    function userSensorModel(int $sensor_id, int $user_id){
        return $this->userSensor->where("type_id",$sensor_id)->where("user_id",$user_id);
    }

    function getUserSleep(User $user){
        $sensor = $this->findSensorTypeByName("accelerometer");
        return [
            "last" => $this->userSensorModel($sensor->id,$user->id)->latest("time")->first(["value","time"])
        ];
    }

    

    function getUserHeardRates(User $user){
        $sensor = $this->findSensorTypeByName("heart_rate");
        $data = [
            "max" => $this->userSensorModel($sensor->id,$user->id)->orderBy("value->0","desc")->first(["value","time"]),
            "min" => $this->userSensorModel($sensor->id,$user->id)->orderBy("value->0","asc")->first(["value","time"]),
            "last" => $this->userSensorModel($sensor->id,$user->id)->latest("time")->first(["value","time"])
        ];
        foreach($data as $key => $item){
            if($item)
                $data[$key]->value = json_decode($item->value)[0];
        }
        return $data;
    }

    function getStepsCount($user){
        $sensor = $this->findSensorTypeByName("step_detector");
        $fromDate = strtotime(now());
        $from = date("Y-m-d",$fromDate);

        $toDate = strtotime(now()->addDay(1));
        $to = date("Y-m-d",$toDate);

        return $this->userSensorModel($sensor->id,$user->id)->where("time",">=",$from)->where("time","<=",$to)->count();
    }
    // User::find(1)->sensors()->where("value->0","1.0")->with("type")->first()
}