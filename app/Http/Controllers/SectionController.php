<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment;
use App\Section;
use App\User;
use Auth;


class SectionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sections = Section::with('users')->get();

        return view('section.index')->with('sections', $sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $sites = Auth::User()->sites()->pluck('name','id');  

         return view('section.create')->with('sites', $sites);
    }

    // /**
    //  * Show the form for adding students to a section.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function addStudents(Section $section)
    // {

    //      $students = User::whereHas('roles', function ($query) { 
    //     $query->where('name', 'like', 'student');
    //         })->whereHas('sites', function ( $query ) use($section) {
    //     $query->where('id', $section->site_id );
    //     })->get()->pluck("'firstName','lastName'",'id');;

    //     //dd($students);            

    //      return view('section.addstudents')->with('students', $students);
    // }

    /**
     * Show the form for adding an assignment to a section.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAssignment(Section $section)
    {
         return view('assignment.create')->with('section', $section);
    }

       /**
     * Show the form for adding an assignment to a section.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAssignmentVue(Section $section)
    {
         return view('assignment.create_vue')->with('section', $section);
    }



     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create valiadator

        $this->validate($request, [
        
            'name' => 'required',
            'label' => 'required',
            'site' => 'required',
            'teacher_id' => 'required',

            ]);

        $section = New Section;
        $section->name = $request->input('name');
        $section->label = $request->input('label');
        $section->teacher_id = $request->input('teacher_id');
        $section->code = $string = str_random(8);
        
        $section->site()->associate($request->input('site'));
        $section->save();

        $section->users()->attach(Auth::User()->id);
        $section->save();

        flash('Section created successfully!', 'success');

        return redirect()->action('HomeController@index');

    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        
        $teacher = User::find($section->teacher_id);

        $assignments = Assignment::where('section_id', $section->id)->get();

        //dd($assignments);

        $students = User::whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
        })->get();
        
        return view('section.show', compact('section','teacher','students', 'assignments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('section.edit')->with('section', $section);

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        // create valiadator
        $this->validate($request, [
        'name' => 'required',
        'label' => 'required',

        ]);

        // get form input data
        
        $section->name = $request->input('name');
        $section->label = $request->input('label');

        $section->save();

        flash('Section updated successfully!', 'success');

        return redirect()->action('SectionController@index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function delete(Section $section)

    {
        return view('section.delete')->with('section', $section);
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
      public function destroy(Section $section)
    {

        $section->delete();

        flash('Section deleted successfully!', 'danger');

        return redirect()->action('SectionController@index');
    }
}
