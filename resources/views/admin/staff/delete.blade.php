@extends('admin.layouts.master')

@section('content')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Pyper Vision</h5>
                    <span>Delete staff</span>
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
	<div class="card-header"><h3>Confrim delete</h3></div>
	<div class="card-body">
        <h2>{{$staff->name}}</h2>
		<form class="forms-sample" action="{{route('staffs.destroy',[$staff->id])}}" method="post" >@csrf
            @method('DELETE')
			
            <div class="card-footer">
                <button type="submit" class="btn btn-danger mr-2">Confrim</button>
                <a href="{{route('staffs.index')}}" class="btn btn-secondary">
                    Cancel
                  
                </a>
            </div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection