@extends('admin.layouts.master')

@section('content')
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
    <i class="ik ik-file-text bg-blue"></i>
    <div class="d-inline">
        <h5>Update Procedure Checklists</h5>
        {{-- <span>Update the Checklist</span> --}}
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
                <a href="{{route('preFlight.index')}} "><strong> Pre-flight Checklist</strong></a>
            </div>
            <div class="card-body">
                <a href=""><strong>Post-flight Checklist</strong></a>
            </div>
        </div>
    </div>
</div>
@endsection