@extends('admin.layouts.master')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-layers bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Staff or Admins</h5>
                            <span>Create Staff or Admin login here</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="row justify-content-center">
<div class="col-md-10">
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{Session::get('message')}}
        </div>
    @endif
<div class="card">
    <div class="card-body">
        <form class="forms-sample" enctype="multipart/form-data" action="{{route('staffs.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputName1">Full name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="exampleInputName1" placeholder="Name" name="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror                
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="exampleInputEmail3" placeholder="Email" name="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail3">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number">
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
                    <div class="form-group">
                        <label>Select a role</label>
                        <select name="roleId" class="form-control @error('roleId') is-invalid @enderror">
                        <option value="">Please select a role</option>
                        @foreach (App\Models\Role::where('id', '>=', Auth::user()->roleId)->get() as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                        </select> 
                        @error('roleId')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select an airport</label>
                        <select name="airportId" class="form-control @error('airportId') is-invalid @enderror">
                            <option value="">Please select an airport</option>
                            {{-- if role is selected as sub-admin, airport name cannot be Admin --}}
                            @if (Auth::user()->roleId==1)
                                @foreach (App\Models\AirportInfo::where('id', '>=', Auth::user()->airportId)->get() as $airport)
                                    <option value="{{$airport->id}}">{{$airport->name=='Admin'? 'Pyper Vision':$airport->name}}</option>
                                @endforeach
                            @else
                                @foreach (App\Models\AirportInfo::where('id', '=', Auth::user()->airportId)->get() as $airport)
                                    <option value="{{$airport->id}}">{{$airport->name}}</option>
                                @endforeach
                                
                            @endif
                            </select> 
                                @error('airportName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                    </div>
                </div>
            </div>
           
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>
</div>
</div>
@endsection
