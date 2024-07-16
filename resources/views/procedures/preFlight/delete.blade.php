@extends('admin.layouts.master')

@section('content')
    
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-edit bg-blue"></i>
                <div class="d-inline">
                    <h5>Delete the task</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-10">
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message')}}
            </div>
            
        @endif

    <div class="card">
        <div class="card-body">
            <h4>Task: {{$checklist->name}} </h4>
            <form class="forms-sample" enctype="multipart/form-data" action="{{ route('preFlight.destroy', $checklist->id)}} " method="POST">
                @csrf
                @method('delete')
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger mr-2">Delete</button>
                    <a href="{{route('preFlight.index')}} "class="btn btn-light">Cancel</a> 
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection