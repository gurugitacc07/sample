@extends('layouts.asidebar')
 
@section('content')
    <div class="row">
        <div class="col-lg-12" style="display: flex; justify-content: space-between;">
            <div class="pull-left">
                <h2>Service</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('services.create') }}"> Assign Service</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Number of Tasks</th>
            <th>Anual Time</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($services as $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->number_of_tasks }}</td>
            <td>{{ $value->anual_time }}</td>
            <td>
                <form action="{{ route('services.destroy',$value->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('services.show',$value->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('services.edit',$value->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $services->links() !!}
      
@endsection