<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HazardReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'dateOfHazard',
        'description',
        'suggestion',
        'userId',
    ];
}
