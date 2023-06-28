@extends('layouts.asidebar')
  
@section('content')
<div class="row">
    <div class="col-lg-12" style="display: flex; justify-content: space-between;">
        <div class="pull-left">
            <h2>Add New Frequency</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('frequencies.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('frequencies.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Frequency Name:</strong>
                <input type="text" name="frequency_name" id="frequency_name" class="form-control" required>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 1%;">
            <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
        </div>
    </div>
   
</form>
@endsection