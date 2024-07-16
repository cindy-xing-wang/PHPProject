<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpsLogByAirportView extends Model
{
    use HasFactory;

    public static function getOpsLog($airportId,$date)
    {
        $opsLogs = DB::table('ops_log_by_airport_view')
        ->where('airportId', $airportId)
        ->whereDate('created_at', $date)
        ->select("*")->get()->toArray();
        // dd($opsLogs);
        // if ($opsLogs[0]->completion) {
        //     $opsLogs[0]->completion ='Yes';
        // } else {
        //     $opsLogs[0]->completion ='No';
        // }
        return $opsLogs;
    }
}
