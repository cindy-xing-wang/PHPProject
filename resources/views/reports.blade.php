@extends('admin.layouts.master')

@section('content')
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
    <i class="ik ik-file-text bg-blue"></i>
    <div class="d-inline">
        <h5>Choose a report</h5>
        {{-- <span>Staff information</span> --}}
    </div>
</div>
</div>
</div>
</div>

<div class="card">

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            <div class="card-body">
                <a href="{{route('accidentReport.index')}} "><strong>Accident Report</strong></a>
            </div>
            <div class="card-body">
                <a href="{{route('hazardReport.index')}} "><strong>Hazard Report</strong></a>
            </div>
        </div>
    </div>
</div>
@endsection