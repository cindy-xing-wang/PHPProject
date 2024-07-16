<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpsLogView extends Model
{
    use HasFactory;
    public $table = "ops_log_view";

    public static function getOpsLog($id)
    {
        $opsLogs = DB::table('ops_log_view')->where('id', $id)->select("*")->get()->toArray();
        // dd($checklist[0]);
        if ($opsLogs[0]->completion) {
            $opsLogs[0]->completion ='Yes';
        } else {
            $opsLogs[0]->completion ='No';
        }
        return $opsLogs;
    }
}
