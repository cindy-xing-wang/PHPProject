<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccidentReport;

class AccidentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.report.accident');
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
        if ($this->validateAccidentForm($request)) {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'accidentLevelId'=> $request->accident_level_id,
                'accidentDate'=> $request->accidentDate,
                'accidentTime'=> $request->accidentTime,
                'accidentLocation'=> $request->accidentLocation,
                'nameInvolvedParty'=> $request->nameInvolvedParty,
                'address'=> $request->address,
                'DOB'=> $request->dateOfBirth,
                'phone'=> $request->phone,
                'injury'=> $request->injury,
                'damage'=> $request->damage,
                'scenario'=> $request->scenario,
                'notified'=> $request->notified,
                'userId' => auth()->user()->id,
            ];
            
            AccidentReport::create($data);
            return redirect()->route('accidentReport.index')->with('message','Accident report completed');
        }
    }
    
    public function validateAccidentForm(Request $request)
    {
        // dd($request);
        return $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'accidentLevelId'=>'required',
            'accidentDate'=>'required',
            'accidentTime'=>'required',
            'accidentLocation'=>'required',
            'nameInvolvedParty'=>'required',
            'address'=>'required',
            'dateOfBirth'=>'required',
            'phone'=>'required',
            'injury'=>'required',
            'damage'=>'required',
            'scenario'=>'required',
            'notified'=>'required',
        ]);
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
}
