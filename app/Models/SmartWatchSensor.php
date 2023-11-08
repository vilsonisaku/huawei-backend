<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartWatchSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
