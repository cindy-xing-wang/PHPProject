<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class PreFlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display checklist table && add new checklist table
        $checklists = Checklist::where('procedureId','1')->get();
        // dd($checklists);
        return view('procedures.preFlight.index',compact('checklists'));
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
        // $checklistData = $request->all();
        // $procedureId = $request->procedureId;
        // $userId = auth()->user()->id;
        // return $userId;
        // for ($i=0; $i < count($checklistData); $i++) { 
        //     if ($request->$i) {
        //         $name = $request->$i;
        //         $this->saveChecklist($i,$name,$procedureId,$userId);
        //     }
        // }
        $checklistData = [
            'stepNum' => 1,
            'name' => $request->name,
            'procedureId' => 1,
            'userId' => auth()->user()->id,
            // 'image' => $request->image,
        ];

        Checklist::create($checklistData);
        return redirect()->route('preFlight.index');
    }

    // public function saveChecklist($stepNum,$name,$procedureId,$userId)
    // {
    //     $checklistData = [
    //         'stepNum' => $stepNum,
    //         'name' => $name,
    //         'procedureId' => $procedureId,
    //         'userId' => $userId
    //     ];

    //     Checklist::create($checklistData);
    // }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklist = Checklist::find($id);
        return view('procedures.preFlight.delete', compact('checklist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checklist = Checklist::find($id);
        return view('procedures.preFlight.edit', compact('checklist'));
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
        $checklist = Checklist::find($id);
        $checklist->delete();
        $checklistData = [
            'stepNum' => 1,
            'name' => $request->task,
            'procedureId' => 1,
            'userId' => auth()->user()->id,
        ];

        Checklist::create($checklistData);
        return redirect()->route('preFlight.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checklist = Checklist::find($id);
        $checklist->delete();
        return redirect()->route('preFlight.index');
    }
}
