<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\OpsLog;
use App\Models\Checklist;
use App\Models\OpsLogView;
use App\Models\ChecklistLog;
use App\Models\ProcedureLog;
use Illuminate\Http\Request;
use App\Mail\PreFlightLogEmail;
use App\Models\PreFlightLogView;
use App\Exports\OpsLogViewExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Exports\OpsLogViewMultiSheetExport;

class PreFlightLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $checklist = Checklist::find(2);
        // $checklistDelete = $checklist->delete();
        $preFlightChecklistLogs = ChecklistLog::find(2)->checklist->name;
        dd($preFlightChecklistLogs);
        foreach ($preFlightChecklistLogs as $preFlightChecklistLog) {
            $preFlightChecklistName = $preFlightChecklistLog->checklist->name;
            // dd($preFlightChecklistName);
        }
        // $preFlightChecklistLog = ChecklistLog::checklist()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checklistData = $request->all();
        $opsId = $request->operationId;
        $procedureLogData = [
            'operationId' => $opsId,
            'procedureId' => 1,
            'logNote' => $request->logNote,
        ];

        ProcedureLog::create($procedureLogData);
        // Find the latest procedure log created by the user
        $operationLog = OpsLog::where('userId',  Auth::user()->id)->latest()->first();
        $procedureLog = ProcedureLog::where('operationId',  $operationLog->id)->latest()->first();
        // Find all tasks in checklists table where id=1 (Pre-flight tasks), add them to a list
        $preFlightTasks = Checklist::where('procedureId', '1')->get();
        $checklistCount = 0;
        foreach ($preFlightTasks as $preFlightTask) {
            $checklistId = $preFlightTask->id;
            if ($request->$checklistId) {
                $procedureLogId = $procedureLog->id;
                $checklistCount ++;
                $this->saveChecklist($procedureLogId,$checklistId);
            }
        }
        if ($checklistCount == count($preFlightTasks)) {
            $procedureLogData['completion'] = true;
            $procedureLog->update($procedureLogData);
            return redirect()->route('ops.create');
        } else {
            //send email to admin when the pre-flight checklist is not finished
            $this->sendPreFlightLogEmail($opsId);

            //test: change operationLog->procedureCompletion = false
            $operationLogCompletion['completion'] = false;
            $operationLog->update($operationLogCompletion);
            // download excel operation log file
            // $this->exportIntoExcel($opsId);
            // front-end pop-up message
            return redirect()->route('ops.create')->with('message', 'Pre-flight checklist is not completed. Operation is canceled and a notification will be sent to Pyper Vision team.');
        }
        // for ($i=0; $i <= count($checklistData); $i++) { 
        //     if ($request->$i) {

        //     }
        // }
    }

    public function saveChecklist($procedureLogId,$checklistId)
    {
        $checklistData = [
            'procedureLogId' => $procedureLogId,
            'checklistId' => $checklistId
        ];

        ChecklistLog::create($checklistData);
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
        //
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
        //
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

    public function sendPreFlightLogEmail($opsId)
    {
        $opsLogView = new OpsLogView();
        $preFlightLogView = new PreFlightLogView();
        $preFlightData = $preFlightLogView->getPreFlightLog($opsId);
        $opsData = $opsLogView->getOpsLog($opsId);
        $data = [
            'opsData' => $opsData,
            'preFlightData' => $preFlightData
        ];

        // dd($data['preFlightData']);
        Mail::to('cindy@test.com')->send(new PreFlightLogEmail($data));
    }

    public function exportIntoExcel($id)
    {
        // return Excel::download(new OpsLogViewExport($id), 'opsLogViewList.xlsx');
        return Excel::download(new OpsLogViewMultiSheetExport($id), 'opsLogViewList.xlsx');
    }
}
