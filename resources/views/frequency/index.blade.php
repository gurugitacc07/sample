@extends('layouts.asidebar')
 
@section('content')
    <div class="row">
        <div class="col-lg-12" style="display: flex; justify-content: space-between;">
            <div class="pull-left">
                <h2>Frequency</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('frequencies.create') }}"> Create New Frequency</a>
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
            <th>Name</th>
            <th>Amount</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($frequencies as $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->frequency_name }}</td>
            <td>{{ $value->amount }}</td>
            <td>
                <form action="{{ route('frequencies.destroy',$value->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('frequencies.show',$value->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('frequencies.edit',$value->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $frequencies->links() !!}
      
@endsection