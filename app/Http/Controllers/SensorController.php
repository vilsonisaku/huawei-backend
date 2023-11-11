<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserSensorRequest;
use App\Http\Requests\GetUserSensorRequest;
use App\Models\SensorType;
use App\Service\SensorService;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    function __construct(protected SensorService $sensorService){}

    function get(){
        return $this->sensorService->getSensorTypes();
    }

    function getUserSensors($name,GetUserSensorRequest $userSensorRequest){
        $user = auth()->user();
        return $this->sensorService->getUserSensors($user,$name,$userSensorRequest->take?:10);
    }

    function createUserSensors($name,CreateUserSensorRequest $request){
        $user = auth()->user();
        return $this->sensorService->updateUserSensors($user,$name,$request->get("data"));
    }

    function getProfile(){
        $user = auth()->user();
        return $this->sensorService->getProfileInfo($user);
    }
}
