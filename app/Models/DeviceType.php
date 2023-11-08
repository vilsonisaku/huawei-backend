<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps=false;

    public function sensorType(){
        return $this->belongsToMany(SensorType::class,SensorDevice::class,"device_type_id","sensor_type_id");
    }

}
