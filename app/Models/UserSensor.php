<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UserSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'time'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(SensorType::class,"type_id");
    }
}
