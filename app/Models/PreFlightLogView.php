<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreFlightLogView extends Model
{
    use HasFactory;

    public static function getPreFlightLog($opsId)
    {
        $preFlightLogs = DB::table('pre_flight_log_view')
        ->where('operation_id', $opsId)
        // ->where('procedureId','1')
        // ->where(['operation_id', $opsId],['procedure_id', '1'])
        ->select("*")
        ->get()
        ->toArray();
        if ($preFlightLogs[0]->pre_flight_completion) {
            $preFlightLogs[0]->pre_flight_completion ='Yes';
        } else {
            $preFlightLogs[0]->pre_flight_completion ='No';
        }
        return $preFlightLogs;
    }
}
