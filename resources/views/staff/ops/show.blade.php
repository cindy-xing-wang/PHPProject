@extends('admin.layouts.master')

@section('content')
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
    <i class="ik ik-calendar bg-blue"></i>
    <div class="d-inline">
        <h5>Calendars</h5>
        {{-- <span>Staff information</span> --}}
    </div>
</div>
</div>
</div>
</div>

<form action="{{route('ops.check')}}" method="post">
    @csrf
    @method('POST')
    <div class="card">
    <div class="card-header"><strong>Choose a date</strong></div>
    <div class="card-body">
        <input type="text" autocomplete="off" name="date" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
       <br>
        <button type="submit" class="btn btn-primary mr-2">Check</button>
    </div>
</div>
</form>

<div class="row">
<div class="col-md-12">
    @if (Session::has('message'))
        <div class="alert bg-success alert-success text-white" role="alert">
            {{ Session::get('message')}}
        </div>
            
    @endif
<div class="card">
<div class="card-body">
    <table class="table">
    {{-- <table id="data_table" class="table"> --}}
        <thead>
            <tr>
                <th class="nosort">Airport</th>
                <th class="nosort">Created By</th>
                <th class="nosort">Completed</th>
                {{-- <th  class="nosort"></th> --}}
                <th class="nosort">Update Ops Log Note</th>
                <th class="nosort">Download log file</th>
                {{-- <th  class="nosort"></th>
                <th  class="nosort"></th> --}}

            </tr>
        </thead>
        <tbody>
            @if (count($opsLogs)>0)
                @foreach ($opsLogs as $opsLog)
                    <tr>
                        <td>
                            @php
                            $user = App\Models\User::find($opsLog->userId);
                            @endphp
                            {{$user->airport->name }}
                        </td>
                        <td>
                            @php
                            $user = App\Models\User::find($opsLog->userId);
                            @endphp
                            {{$user->name }}
                        </td>
                        {{-- <td>{{$opsLog->user->name}}</td> --}}
                            @php
                             if ($opsLog->completion) {
                                 echo '<td>Yes</td>';
                             }  else {
                                 echo '<td>No</td>';
                             }
                            @endphp
                        <td>
                            {{-- <div class="table-actions"> --}}
                                {{-- <a href="#" data-toggle="modal" data-target="#exampleModal{{$staff->id}}"><i class="ik ik-eye"></i></a> --}}
                                {{-- <a href="{{route('opsLog.edit', $opsLog->id)}} ">Update</a> --}}
                                <a href="{{route('ops.edit', $opsLog->id)}} "><i class="ik ik-edit-2"></i></a>
                                {{-- <a href="{{route('opsLog.show', $opsLog->id)}}"><i class="ik ik-trash-2"></i></a> --}}
                            {{-- </div> --}}
                        </td>
                        <td><a href="{{url('/export-excel',$opsLog->id)}}">Download</a></td>
                        <td></td>
                        {{-- <td></td> --}}
                    </tr>
                    {{-- View Modal --}}
                    {{-- @include('admin.staff.modal') --}}
                @endforeach
            @else
                <td>No records found</td>
            @endif
            
        </tbody>
    </table>
</div>
</div>
</div>
</div>
@endsection