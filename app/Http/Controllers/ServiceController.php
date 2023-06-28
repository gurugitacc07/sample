<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frequency;
use App\Models\Service;
use App\Models\Task;
use App\Models\Action;
class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::latest()->paginate(5);
        
        return view('service.index',compact('services'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    public function create()
    {
        $frequencies = Frequency::get();
        return view('service.add')->with(['frequencies'=>$frequencies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'number_of_tasks' => 'required',
            'anual_time' => 'required',
            'task_name' => 'required',
            'frequency_id' => 'required',
        ]);


        $service = new Service();

        $service->number_of_tasks = $request->number_of_tasks;
        $service->anual_time = $request->anual_time;
        $service->daily_service_date = $request->daily_service_date;
        $service->weekly_service_date = $request->weekly_service_date;
        $service->monthly_service_date = $request->monthly_service_date;
        $service->daily_total_timing = $request->daily_total_timing;
        $service->weekly_total_timing = $request->weekly_total_timing;
        $service->monthly_total_timing = $request->monthly_total_timing;
        $service->save();
        
        
        for ($i=0; $i < count($request->task_name); $i++) { 

            $task = new Task();

            $task->service_id = $service->id;
            $task->task_name = $request->task_name[$i];
            $task->task_timing = $request->task_timing[$i];
            $task->frequency_id = $request->frequency_id[$i];
            $task->save();

            // Store the actions
            // for ($j=0; $j < count($request->action_name); $j++) { 

            //     $action = new Action();

            //     $action->task_id = $task->id;
            //     $action->action_name = $request->action_name[$j];
            //     $action->action_timing = $request->action_timing[$j];
            //     $action->save();
            // }

        }


        return redirect()->route('services.index')
                        ->with('success','Service created successfully.');
    }

    public function show(Service $service)
    {
        $service_tasks = Task::where('service_id',$service->id)
                            ->leftjoin('frequencies','frequencies.id','=','tasks.frequency_id')
                            ->leftjoin('actions','actions.task_id','=','tasks.id')
                            ->get();
        return view('service.show',compact('service','service_tasks'));
    }

    
}



        