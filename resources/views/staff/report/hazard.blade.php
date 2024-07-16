@extends('admin.layouts.master')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>Hazard report</h5>
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
        <form class="forms-sample" enctype="multipart/form-data" action="{{route('hazardReport.store')}}" method="POST">
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
                        <label for="">Date of Hazard</label>
                        <input type="text" autocomplete="off" name="dateOfHazard" class="form-control datetimepicker-input @error('dateOfHazard') is-invalid @enderror" id="datepicker2" data-toggle="datetimepicker" data-target="#datepicker2">
                        @error('dateOfHazard')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror                      
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">Describe the hazard you have identified (including location)</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1" rows="4"name="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
            </div>
            <div class="form-group">
                <label for="exampleTextarea1">Describe and explain any suggestions you have for minimising
                    or eliminating the hazard.</label>
                <textarea class="form-control @error('suggestion') is-invalid @enderror" id="exampleTextarea1" rows="4"name="suggestion">{{ old('suggestion') }}</textarea>
                @error('suggestion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror  
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