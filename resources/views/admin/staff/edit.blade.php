@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Pyper Vision</h5>
                    <span>Update staff info</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
	<div class="col-lg-10">
        @if(Session::has('message'))
            <div class="alert bg-success alert-success text-white" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
       
	<div class="card">
	<div class="card-body">
		<form class="forms-sample" action="{{route('staffs.update',[$staff->id])}}" method="post" enctype="multipart/form-data" >@csrf
            @method('PUT')
			<div class="row">
				<div class="col-lg-6">
					<label for="">Full name</label>
					<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="doctor name" value="{{$staff->name}}">
                    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>
				<div class="col-lg-6">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email"value=" {{$staff->email}}">
                     @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div>
			</div>

			<div class="row">
				{{-- <div class="col-lg-6">
					<label for="">Password (leave it blank if you do not want to change it)</label>
					<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
                     @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
				</div> --}}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"value="{{$staff->phone}}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                    </div>
                </div>
				
			</div>

            <div class="row">
                    <div class="col-md-6">
                        <label>Role</label>
                        <select name="roleId" class="form-control @error('roleId') is-invalid @enderror">
                            <option value="">Please select a role</option>
                            @foreach (App\Models\Role::where('id', '>=', Auth::user()->roleId)->get() as $role)
                                <option value="{{$role->id}}" @if($staff->roleId==$role->id)selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                         @error('roleId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select an airport</label>
                            <select name="airportId" class="form-control @error('airportId') is-invalid @enderror">
                                <option value="">Please select an airport</option>
                                {{-- if role is selected as sub-admin, airport name cannot be Admin --}}
                                @if (Auth::user()->roleId==1)
                                    @foreach (App\Models\AirportInfo::where('id', '>=', Auth::user()->airportId)->get() as $airport)
                                        <option value="{{$airport->id}}" @if($staff->airportId==$airport->id)selected @endif>{{$airport->name}}</option>
                                    @endforeach
                                @else
                                    @foreach (App\Models\AirportInfo::where('id', '=', Auth::user()->airportId)->get() as $airport)
                                        <option value="{{$airport->id}}" @if($staff->airportId==$airport->id)selected @endif>{{$airport->name}}</option>
                                    @endforeach
                                    
                                @endif
                                </select> 
                            {{-- <input type="text" name="airportName" class="form-control @error('airportName') is-invalid @enderror"> --}}
                                    @error('airportName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            
                        </div>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{route('staffs.index')}}" class="btn btn-light">
                Cancel
            </a>
            {{-- <button class="btn btn-light">Cancel</button> --}}


				</form>
			</div>
		</div>
	</div>
</div>


@endsection