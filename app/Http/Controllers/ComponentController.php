<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Component;
use App\Assignment;
use Carbon\Carbon;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responseå
     */
    public function index()
    {
        $components = Component::all();
        
        return view('component.index')->with(compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Assignment $assignment)
    {
        
        //dd($assignment);

        // $assignment = Assignment::findOrFail($assignment);

        return view('component.create')->with('assignment', $assignment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($component)
    {
        return view('component.show')->with('component', $component);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Component $component)
    {

        $component = Component::findOrfail($component->id);

        //dd($component);

        return view('component.edit')->with('component', $component);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
        
        'title' => 'required',
        'assignment_id' => 'required',
        'date_due' => 'date_format:"m-d-y"|required',

        ]);
        
        //create a new component instance
        $component = New Component;

        //set and title information
        $component->title = $request->input('title');

        //set assignment id 
        $component->assignment_id = $request->input('assignment_id');
        
        //set component date due

        $date_due = Carbon::createFromFormat('m-d-y', $request->input('date_due'));

        //set component time due
        $date_due->hour = 23;
        $date_due->minute = 59;
        $date_due->second = 59;

        $date_due->toDateTimeString(); 
        $date_due->setTimezone('UTC');

        $component->date_due = $date_due;
        $component->save();

        $assignment = Assignment::findOrFail($component->assignment_id);

        flash('Component created successfully!', 'success');

        return view('assignment.show')->with('assignment', $assignment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Component $component)
    {
        
        $this->validate($request, [
        
        'title' => 'required',
        'date_due' => 'date_format:"m-d-y"|required',
        ]);

        //dd($request->input('title'));
        //dd($request->input('date_due'));

       //set component date due
        //$date_due = Carbon::parse($request->input('date_due'));

        $date_due = Carbon::createFromFormat('m-d-y', $request->input('date_due'), 'America/New_York');

        //dd($date_due);
        
        //set component time due
        $date_due->hour = 23;
        $date_due->minute = 59;
        $date_due->second = 59;

        $date_due->toDateTimeString(); 
        $date_due->setTimezone('UTC');

        $component->date_due = $date_due;
        $component->save();

        $component->title = $request->input('title');
        $component->date_due = $date_due;

        $component->save();

        $assignment = Assignment::findOrFail($component->assignment_id);

        flash('Component updated successfully!', 'success');

        return view('assignment.show')->with('assignment', $assignment);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function delete(Component $component)

    {
        //dd($component);

        return view('component.delete')->with('component', $component);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Component $component)
    {
        
        $assignment = Assignment::findOrfail($component->assignment_id);

        $component->delete();

        flash('Component deleted successfully!', 'danger');

        return view('assignment.show')->with('assignment', $assignment);

    }
}
