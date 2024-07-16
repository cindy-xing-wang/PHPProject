<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'accidentLevelId',
        'accidentDate',
        'accidentTime',
        'accidentLocation',
        'nameInvolvedParty',
        'address',
        'DOB',
        'phone',
        'injury',
        'damage',
        'scenario',
        'notified',
        'userId',
    ];
}
