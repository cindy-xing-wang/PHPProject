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
@if (Session::has('message'))
    <div class="alert alert-warning">
        {{Session::get('message')}}
    </div>
@endif

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

@endsection