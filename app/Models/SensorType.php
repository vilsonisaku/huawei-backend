<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps=false;

    public function sensors(){
        return $this->hasMany(UserSensor::class,"type_id");
    }

    public function devices(){
        return $this->belongsToMany(SensorType::class);
    }
}
