<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChecklistLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'procedureLogId',
        'checklistId',
	];

    public function checklist() {
        return $this->belongsTo('App\Models\Checklist','checklistId')->withTrashed();
        // return $this->belongsTo(Checklist::class)->withTrashed();
    }
}
