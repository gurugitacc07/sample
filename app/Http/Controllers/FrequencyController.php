<?php

namespace App\Http\Controllers;

use App\Models\Frequency;
use Illuminate\Http\Request;
use Auth;
class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frequencies = Frequency::latest()->paginate(5);
    
        return view('frequency.index',compact('frequencies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frequency.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'frequency_name' => 'required',
        ]);
        $service = new Frequency();

        $service->frequency_name = $request->frequency_name;
        $service->save();
     
        return redirect()->route('frequencies.index')
                        ->with('success','Frequency created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Frequency $frequency)
    {
        return view('frequency.show',compact('frequency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Frequency $frequency)
    {
        return view('frequency.edit',compact('frequency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frequency $frequency)
    {
        $request->validate([
            'frequency_name' => 'required',
        ]);

        $frequency->update($request->all());
    
        return redirect()->route('frequencies.index')
                        ->with('success','Frequency updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frequency $frequency)
    {
        $frequency->delete();
    
        return redirect()->route('frequencies.index')
                        ->with('success','Frequency deleted successfully');
    }
}
