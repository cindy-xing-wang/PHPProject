<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OpsLog;
use App\Models\Checklist;
use App\Models\OpsLogView;
use App\Models\AirportInfo;
use App\Models\SupportCrew;
use Illuminate\Http\Request;
use App\Mail\HighWindSpeedEmail;
use App\Models\OpsLogByAirportView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.ops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $airportId = AirportInfo::where('id','=',Auth::user()->airportId)->get()
        return view('staff.ops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $this->validateOpsCompletion($request))
        {
             $data = [
                'windSpeed' => $request->windSpeed,
                'temperature' => $request->temperature,
                'visibility' => $request->visibility,
                'droneId' => $request->droneId,
                'pilotId' => $request->pilotId,
                'flightPathId' => $request->flightPathId,
                'userId' => auth()->user()->id,
                // 'logNote' => $request->logNote,
            ];

            if ($request->windSpeed > 8) {
                $data['completion'] = false;
                $data['logNote'] = 'Wind Speed was more than 8 Knots.';
            } else {
                $data['completion'] = true;
            }
            OpsLog::create($data);
            $supportCrews = User::where('airportId', '=', Auth::user()->airportId)->get();
            $opsLog = OpsLog::where('userId',  Auth::user()->id)->latest()->first();
            // dd($opsLog);
            $opsLogId = $opsLog->id;
        //    for ($i=0; $i < count($supportCrews); $i++) { 
        //         $supportCrewId = $supportCrews[$i]->id;
        //         if ($request->$supportCrewId) {
        //             $this->saveSupportCrew($supportCrewId,$opsLogId);
        //         }
        //    }
            foreach ($supportCrews as $supportCrew) {
                $supportCrewId = $supportCrew->id;
                if ($request->$supportCrewId) {
                    $this->saveSupportCrew($supportCrewId,$opsLogId);
                }    
            }
            if ($data['completion']) {

                // return redirect()->route('preFlightLog.index');
                $checklists = Checklist::where('procedureId','1')->get();
                $data = [
                    'tasks' => $checklists,
                    'operationId' => $opsLogId,
                ];
                return view('staff.preFlightLog.index',compact('data'));
                // return redirect()->back()->with('message', 'Pre-flight checklist');
            } else {
                // send email to Pyper Vision team
                $this->sendHighWindSpeedEmail($opsLogId);
                // front-end pop-up message
                return redirect()->back()->with('message', 'Wind Speed is more than 8 Knot. Operation is canceled and a notification will be sent to Pyper Vision team.');
                // return redirect()->route('ops.index')->with('message', 'Pre-flight checklist');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checklist = OpsLog::find($id);
        // dd($checklist);
        return view('staff.ops.edit', compact('checklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->logNote;
        // dd($data);
        $checklist = OpsLog::find($id);

        $checklist->logNote = $data;
        $checklist->save();
        //should go to check method with date and display msg.
        return redirect()->route('ops.index')->with('message', 'Log Note updated successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check(Request $request)
    {
        // dd($request);
        $date = $request->date;
        // $checklists = PreFlight::where('created_at'->format('Y-m-d'), $date)->first();

        // find user role id, filter log results according to different roles
        if (Auth::user()->roleId==1) {
            $opsLogs = OpsLog::whereDate('created_at', $date)->get();
            return view('staff.ops.show',compact('opsLogs'));
        }
        if (Auth::user()->roleId==2|| Auth::user()->roleId==3) {
            $opsLogs = $this->filterOpsResult(Auth::user()->airportId, $date);
            return view('staff.ops.show',compact('opsLogs'));
        }
    }

    public function validateOpsCompletion(Request $request)
    {
        return $this->validate($request,[
            'windSpeed'=>'required',
            'temperature'=>'required',
            'visibility'=>'required',
            'droneId'=>'required',
            'flightPathId'=>'required',
            'pilotId'=>'required',
            // 'supportCrewId'=>'required',
        ]);
    }

    public function saveSupportCrew($userId, $opsLogId)
    {
        $supportCrew = [
            'userId' => $userId,
            'opsLogId' => $opsLogId,
        ];

        SupportCrew::create($supportCrew);
    }

    public function sendHighWindSpeedEmail($id)
    {
        $opsLogView = new OpsLogView();
        $data = $opsLogView->getOpsLog($id);
        // $data = [

        // ];

        Mail::to('cindy@test.com')->send(new HighWindSpeedEmail($data));
    }

    public function filterOpsResult($airportId, $date)
    {
        $opsLogByAirport = new OpsLogByAirportView();
        return $opsLogByAirport->getOpsLog($airportId, $date);
    }
}
