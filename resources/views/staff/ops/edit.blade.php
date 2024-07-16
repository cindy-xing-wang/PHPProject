@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-calendar bg-blue"></i>
                <div class="d-inline">
                    <h5>Update Log Note</h5>
                    {{-- <span>Update staff info</span> --}}
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
		<form class="forms-sample" action="{{route('ops.update',[$checklist->id])}}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
			<div class="row">
				<div class="col-lg-6">
					<span><strong>Wind Speed</strong></span>
                    <p>{{$checklist->windSpeed}} knots</p>
				</div>
				<div class="col-lg-6">
					<span><strong>Temperature</strong></span>
                    <p>{{$checklist->temperature}} &deg;C</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<span><strong>Visibility</strong></span>
                    <p>{{$checklist->visibility}} meters</p>
				</div>
				
			</div>

            <div class="row">
                    <div class="col-md-12">
                        <label><strong>Log Note</strong></label>
                        <textarea class="form-control @error('logNote') is-invalid @enderror" id="exampleTextarea1" rows="4" name="logNote">{{$checklist->logNote}}
                            </textarea>
                            @error('logNote')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            {{-- should go back to check method display checklist--}}
            <a href="{{route('ops.index')}}" class="btn btn-light">
                Cancel
              
            </a>
            {{-- <button class="btn btn-light">Cancel</button> --}}


				</form>
			</div>
		</div>
	</div>
</div>


@endsection