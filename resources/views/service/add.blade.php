@extends('layouts.asidebar')
  <style>
    .action_fields{
        display: flex;
    justify-content: center;
    width:100%;
    gap: 20px;
}
    }
  </style>
@section('content')
<div class="row">
    <div class="col-lg-12" style="display: flex; justify-content: space-between;">
        <div class="pull-left">
            <h2>Add New Service</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('services.index') }}"> Back</a>
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
   
<form action="{{ route('services.store') }}" method="POST">
    @csrf
  
     <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Number of Tasks:</strong>
                    <input type="text" name="number_of_tasks" id="number_of_tasks" value="1" class="form-control" placeholder="Number of Tasks" readonly>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Annual Time:</strong>
                    <input type="text" name="anual_time" value="" class="form-control anual_time" placeholder="anual_time" readonly>
                </div>
            </div>
            @foreach($frequencies as $val)
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{$val->frequency_name}} Date:</strong>
                    <input type="text" name="{{$val->frequency_name}}_service_date" value="" class="form-control" placeholder="1,2,3">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>{{$val->frequency_name}} Time:</strong>
                    <input type="text" name="{{$val->frequency_name}}_total_timing" id="{{$val->frequency_name}}_total_timing" value="" class="form-control" placeholder="00:00">
                </div>
            </div>
            @endforeach
            

            <table id="myTable" class=" table order-list">
                <thead>
                    <tr>
                        <td>Task Title</td>
                        <td>Frequency</td>
                        <td>Time (In min)</td>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1">
                        <td class="col-sm-4">
                            <input type="text" name="task_name[]" id="task_name1" data-id="1" class="form-control task_name" placeholder="Task Title"/>
                        </td>
                        <td class="col-sm-4">
                            <div class="form-group">
                                <select class="form-select frequency_id" aria-label="multiple select example" name="frequency_id[]" id="frequency_id1" data-id="1">
                                    <option selected>Open this select menu</option>
                                    @foreach($frequencies as $val)
                                    <option value="{{$val->id}}">{{$val->frequency_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td class="col-sm-3">
                            <input type="text" name="task_timing[]" id="task_timing1" data-id="1" class="form-control task_timing" value="0" readonly />
                        </td>
                        <td class="col-sm-2"><a class="deleteRow btn btn-danger" data-id="1">Delete</a>

                        </td>
                    </tr>
                    <tr id="11">
                        <td colspan="3">
                            <div class="row">
                                <div class="col-6" style="text-align: center;">
                                    <h5>Action</h5>
                                </div>
                                <div class="col-6" style="text-align: center;">
                                    <input type="button" class="btn btn-success " id="addchildrow" value="+" />
                                </div>
                            </div>
                            <div class="action_clone">
                            <div class="action_fields">
                                <div><label>Type</label>
                                    <input type="textbox" class="action_name" data-id="11" id="action_name11" name="action_name[]" placeholder="Action">
                                </div>
                                  <div><label>Time</label>
                                    <input type="textbox" data-id="11" class="action_timing" id="action_timing11" name="action_timing[]" placeholder="00.00">
                                </div>
                            </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input type="button" class="btn btn-info " id="addrow" value="Add Row" />
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>


            <input type="text" name="grandtotal" id="grandtotal" value="0" class="form-control"/>

            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 1%;">
              <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
            </div>
        </div>
   
</form>
@endsection
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;
        var rowCount = $(".task_name").length+1;
        $("#addrow").on("click", function () {
            var newRow = $('<tr id="'+rowCount+'">');
            var newRow2 = $('<tr id="'+rowCount+'1">');
            var cols = "";
            var cols2 = "";
            cols += '<td><input type="text" class="form-control task_name" id="task_name'+rowCount+'" data-id="'+rowCount+'" name="task_name[]" placeholder="Task Title"/></td>';

            cols += '<td class="col-sm-4"><div class="form-group"><select class="form-select frequency_id" aria-label="multiple select example" name="frequency_id[]" id="frequency_id'+rowCount+'" data-id="'+rowCount+'"><option selected>Open this select menu</option>@foreach($frequencies as $val)<option value="{{$val->id}}">{{$val->frequency_name}}</option>@endforeach</select></div></td>';
            
            cols += '<td><input type="text" class="form-control task_timing" id="task_timing'+rowCount+'" data-id="'+rowCount+'" name="task_timing[]" value="0"/></td>';

            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger " data-id="'+rowCount+'" value="Delete"></td>';

            cols2 += '<td colspan="3"><div class="row"><div class="col-6" style="text-align: center;"><h5>Action</h5></div><div class="col-6" style="text-align: center;"><input type="button" class="btn btn-success " id="addchildrow" value="+" /></div></div><div class="action_clone"><div class="action_fields"><div><label>Type</label><input type="textbox" class="action_name" data-id="'+rowCount+'1" id="action_name'+rowCount+'1" name="action_name[]" placeholder="Action"></div><div><label>Time</label><input type="textbox" data-id="'+rowCount+'1" class="action_timing" id="action_timing'+rowCount+'1" name="action_timing[]" placeholder="00.00"></div></div></div></td></tr>';

            newRow.append(cols);
            newRow2.append(cols2);
            $("table.order-list").append(newRow,newRow2);
            // $("table.order-list").append(newRow2);
            rowCount++;
            $("#number_of_tasks").val(rowCount);

            counter++;
        });



        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });


    });



$(document).on('change', '.task_timing', function() {
    bottom_calculation_single_item_based();
});



$(document).on('click', '#addchildrow', function() {
    var parentrowCount = $(".task_name").length;
    var childCount = $('.action_name').length+1;
    alert(childCount);
    var newchildRow = $('<div class="action_fields"><div><label>Type</label><input type="textbox" class="action_name" data-id="'+parentrowCount+''+childCount+'" id="action_name'+parentrowCount+''+childCount+'" name="action_name[]" placeholder="Action"></div><div><label>Time</label><input type="textbox" data-id="'+parentrowCount+''+childCount+'" class="action_timing" id="action_timing'+parentrowCount+''+childCount+'" name="action_timing[]" placeholder="00.00"></div></div>');
  
    // newchildRow.append(childcols);
    $(".action_clone").append(newchildRow);
    childCount++;
});

function bottom_calculation_single_item_based(){
var dtotal = 0;
var wtotal = 0;
var mtotal = 0;
var atotal = 0;
    for(var i = 0; i < $(".task_timing").length;i++){
        var freq_val = $(".frequency_id").eq(i).val();
        var checkValue = parseFloat($(".task_timing").eq(i).val());
        if(checkValue){

            if (freq_val == "1") {
                dtotal = parseFloat(dtotal) + parseFloat(checkValue);
                $("#daily_total_timing").val(dtotal);
            }
            if (freq_val == "2") {
                wtotal = parseFloat(wtotal) + parseFloat(checkValue);
                $("#weekly_total_timing").val(wtotal);
            }
            if (freq_val == "3") {
                mtotal = parseFloat(mtotal) + parseFloat(checkValue);
                $("#monthly_total_timing").val(mtotal);
            }

            atotal = dtotal+wtotal+mtotal;
            $(".anual_time").val(atotal);
        }
        
    }
}

</script>>