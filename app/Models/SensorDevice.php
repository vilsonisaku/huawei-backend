<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorDevice extends Model
{
    use HasFactory;

    public $timestamps=false;

    public function sensorType(){
        return $this->belongsTo(SensorType::class);
    }
}
