@extends('admin.layouts.master')

@section('content')
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
    <i class="ik ik-calendar bg-blue"></i>
    <div class="d-inline">
        {{-- <h5>List of Real Healthy Me Staff</h5> --}}
        <h5>Pre-flight checklists</h5>
    </div>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
    @if (Session::has('message'))
        <div class="alert bg-success alert-success text-white" role="alert">
            {{ Session::get('message')}}
        </div>
            
    @endif
<div class="card">
<div class="card-body">
    <table  class="table">
        <thead>
            <tr>
                {{-- <th class="nosort">Steps</th> --}}
                <th class="nosort">Tasks</th>
                <th class="nosort"></th>
                <th class="nosort"></th>

            </tr>
        </thead>
        <tbody>
            @if (count($checklists)>0)
                @foreach ($checklists as $checklist)
                    <tr>
                        {{-- <td>{{$checklist->stepNum}}</td> --}}
                        {{-- <td><img src="{{asset('images')}}/{{$checklist->image}}" class="table-user-thumb" alt=""></td> --}}
                        <td>{{$checklist->name}}</td>
                        <td>
                            <div class="table-actions">
                                {{-- <a href="#" data-toggle="modal" data-target="#exampleModal{{$staff->id}}"><i class="ik ik-eye"></i></a> --}}
                                <a href="{{route('preFlight.edit', $checklist->id)}} "><i class="ik ik-edit-2"></i></a>
                                <a href="{{route('preFlight.show', $checklist->id)}}"><i class="ik ik-trash-2"></i></a>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            @else
                <td>No tasks found</td>
            @endif
            
        </tbody>
    </table>

</div>
</div>
<div class="card">
    <div class="card-body">
    <h6><strong> Add a new task in Pre-flight checklists</strong></h6> <br>
    <form class="forms-sample" enctype="multipart/form-data" action="{{route('preFlight.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="exampleInputName1">New task</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="exampleInputName1" placeholder="Name" name="name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror                
            </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Add</button>
        {{-- <button class="btn btn-light">Cancel</button> --}}
    </form>
</div>
</div>
</div>
</div>
@endsection