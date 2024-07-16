<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpsLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'windSpeed',
        'temperature',
        'visibility',
        'droneId',
        'pilotId',
        'userId',
        'flightPathId',
        'logNote',
        'completion',
    ];
}
