<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use App\Component;
use App\Section;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Section $section)
    {
       return view('assignment.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form

        $this->validate($request, [
        
        'title' => 'required',
        //'description' => 'required',
        'components.*' => 'required',
        'section_id' => 'required',

        ]);


        //set and persist assignment information to database

        $assignment = New Assignment;
        
        $assignment->title = $request->input('title');
        $assignment->description = $request->input('description');
        $assignment->section_id = $request->input('section_id');
        $assignment->date_due = $request->input('date_due');
        $assignment->active = false;
        $assignment->save();

        $components = $request->input('components');

        
    // Really ugly solutin here that came about because I couldn't wrap
    // my head around how to access assciative arrays. I set a loop
    // counter in order to set the first component as the primary image.
    // (That's the one the kids will see on their hoome/ portfolio page.)
    // Eventually, some one is going to want to have more than one primary // image. 

        // set counter

            $i = -1;

            foreach ($components['title'] as $component ){

        // increment counter

            $i++;

             $newComponent = New Component;

             $newComponent->title = $component;
             $newComponent->assignment_id = $assignment->id;
             $newComponent->date_due = $request->input('date_due');
             
             if ($i == 0 ) {

                $newComponent->is_primary = true ;

             }

             else { 

                $newComponent->is_primary = false;
            
             }

             $newComponent->save();

       }

        flash('Assignment created successfully!', 'success');

        return redirect()->action('SectionController@show', $assignment->section_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
       //dd($assignment);


       $assignment = Assignment::with(array('components' => function ($query) {
        $query->orderBy('date_due', 'asc');
        }
        ))->where('id', $assignment->id)->first();

       //dd($assignment);

        return view('assignment.show')->with('assignment', $assignment);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        
        return view('assignment.edit')->with('assignment', $assignment);

    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        // create valiadator
        $this->validate($request, [
        'title' => 'required',
        ]);

        // get form input data
        
        $assignment->title = $request->input('title');
        $assignment->description = $request->input('description');
        $assignment->description = $request->input('date_due');

        $assignment->save();

        flash('Assignment updated successfully!', 'success');

        return redirect()->action('AssignmentController@show', $assignment->id );
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function delete(Assignment $assignment)

    {
        //dd($assignment);

        return view('assignment.delete')->with('assignment', $assignment);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
         $components = Component::where('assignment_id', $assignment->id)->get();

         foreach ($components as $component){

         $component->delete();

         }

        $assignment->delete();

        flash('Assignment deleted successfully!', 'danger');

        return redirect()->action('SectionController@show', $assignment->section_id );
    }
}
