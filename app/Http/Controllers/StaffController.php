<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->name=="admin")
        {
            $staffs = User::get();
            // $staffs = User::All();
            return view('admin.staff.index',compact('staffs'));
        } elseif (Auth::user()->role->name=="sub-admin") {
            $staffs = User::where('airportId','=',Auth::user()->airportId)->get();
            // $airportId = $users->airport()
            // $usersInAirport = $users::where('airport_id', '=',Auth::user()->airport_id)->get();
            return view('admin.staff.index',compact('staffs'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        // dd($request);
        $data = $request->all();
        
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->back()->with('message','Staff added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = User::find($id);
        return view('admin.staff.delete', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = User::find($id);
        return view('admin.staff.edit', compact('staff'));
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
        $this->validateUpdate($request, $id);
        $data = $request->all();
        $staff = User::find($id);
        // $staffPassword = $staff->password;

        // if ($request->password) {
        //     $data['password'] = Hash::make($request->password);
        // }else{
        //     $data['password'] = $staffPassword;
        // }
        // dd($data);
        $staff->update($data);
        return redirect()->route('staffs.index')->with('message', 'Staff info updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->id == $id){
            return redirect()->route('staffs.index')->with('message','Not able to delete yourself');
       }
       $user = User::find($id);
       $userDelete = $user->delete();
        return redirect()->route('staffs.index')->with('message','Staff deleted successfully');
    }

    public function validateStore(Request $request){

        return  $this->validate($request,[
            'name'=>'required|string|max:50',
            'email'=>'required|string|email|max:64|unique:users,email',
            'password'=>'required|string|min:8|max:25',
            // phone number needs to be validated in front-end
            // 'phone'=>'string|max:25',
            'roleId'=>'required',
            'airportId' => 'required',
       ]);
    }

    public function validateUpdate(Request $request, $id){
        return  $this->validate($request,[
            'name'=>'required|string|max:50',
            'email'=>'required|string|email|max:64',
            //research about how to handle password when updating user info
            // 'password'=>'string|min:8|max:25',
            // 'phone'=>'string|max:25',
            'roleId'=>'required',
            'airportId' => 'required',
            // 'name'=>'required',
            // 'email'=>'required|unique:users,email,'.$id,
            // 'phone'=>'numeric|max:25',
            // 'role_id'=>'required',
       ]);
    }
}
