<?php

namespace App\Http\Controllers;

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
        return $this->sensorService->getUserSensors($name,$userSensorRequest->take?:10);
    }

    function updateUserSensors(){
        // return $this->sensorService->updateUserSensors();
    }
}
