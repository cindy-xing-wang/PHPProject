@extends('admin.layouts.master')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>Accident report</h5>
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
        <form class="forms-sample" enctype="multipart/form-data" action="{{route('accidentReport.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="exampleInputName1">Full name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="exampleInputName1" placeholder="Reporter Name" name="name">
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
                        <label for="exampleInputEmail3">How serious was the accident?</label>
                        <select name="accidentLevelId" class="form-control @error('accidentLevelId') is-invalid @enderror">
                            <option value="">Please select one</option>
                            @foreach (App\Models\AccidentLevel::get() as $level)
                             <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                         </select> 
                         @error('accidentLevelId')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror                  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleSelectGender">Date of Accident</label>
                        <input type="text" autocomplete="off" name="accidentDate" class="form-control datetimepicker-input @error('accidentDate') is-invalid @enderror" value="{{ old('accidentDate') }}" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
                        @error('accidentDate')
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
                        <label for="exampleInputPassword4">Time of Accident</label>
                        <input type="text" class="form-control @error('accidentTime') is-invalid @enderror" value="{{ old('accidentTime') }}"  id="exampleInputPassword4" name="accidentTime" placeholder="Time of accident">
                        @error('accidentTime')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword4">Location of Accident</label>
                        <input type="text" class="form-control @error('accidentLocation') is-invalid @enderror" value="{{ old('accidentLocation') }}" id="exampleInputPassword4" name="accidentLocation" placeholder="Location of Accident">
                        @error('accidentLocation')
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
                        <label for="exampleInputName1">Name of Involved Party</label>
                        <input type="text" class="form-control @error('nameInvolvedParty') is-invalid @enderror" value="{{ old('nameInvolvedParty') }}" id="exampleInputName1" placeholder="Name of Involved Party" name="nameInvolvedParty">
                        @error('nameInvolvedParty')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                     
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputName1">Address of Involved Party</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" id="exampleInputName1" placeholder="Address of Involved Party" name="address">
                        @error('address')
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
                        <label for="">Date of Birth of Involved Party</label>
                        <input type="text" autocomplete="off" name="dateOfBirth" class="form-control datetimepicker-input @error('dateOfBirth') is-invalid @enderror" id="datepicker2" data-toggle="datetimepicker" data-target="#datepicker2">
                        @error('dateOfBirth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror                      
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone number of Involved Party</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror                        
                    </div>
                </div>
               
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">Describe Injuries</label>
                <textarea class="form-control @error('injury') is-invalid @enderror" id="exampleTextarea1" rows="4"name="injury">{{ old('injury') }}</textarea>
                @error('injury')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">Describe Damage to Property/Equipment</label>
                <textarea class="form-control @error('damage') is-invalid @enderror" id="exampleTextarea1" rows="4"name="damage">{{ old('damage') }}</textarea>
                @error('damage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">Describe the Accident Scenario</label>
                <textarea class="form-control @error('scenario') is-invalid @enderror" id="exampleTextarea1" rows="4"name="scenario">{{ old('scenario') }}</textarea>
                @error('scenario')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>

            <div class="form-group">
                <label for="">Have you notified relevant parties (H&S manager, Worksafe if required)?</label>
                <div>
                    <input type="radio" id="yes" name="notified" value=1>
                    <label for="preFlight">Yes</label>
                </div>
                <div>
                    <input type="radio" id="no" name="notified" value=0>
                    <label for="postFlight">No (If not, please do notify, ASAP)</label>
                </div>                      
            </div>
            
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{url('reports')}}" class="btn btn-secondary">
                Cancel
              
            </a>
        </form>
    </div>
</div>
</div>
</div>
@endsection