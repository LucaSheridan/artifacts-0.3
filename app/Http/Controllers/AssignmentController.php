<?php

namespace App\Http\Controllers;

use App\Artifact;
use App\Assignment;
use Illuminate\Http\Request;
use App\Component;
use App\Section;
use App\Project;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

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
       return view('assignment.create')->with('section', $section);
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
        // 'description' => 'required',
        'section_id' => 'required',

        ]);

        //set and persist assignment information to database

        $assignment = New Assignment;
        
        $assignment->title = $request->input('title');
        //$assignment->description = $request->input('description');
        $assignment->section_id = $request->input('section_id');
        $assignment->active = true;
        $assignment->save();

        //$assignment = Assignment::findOrFail($assignment->id)->with('components');

        flash('Assignment created successfully!', 'success');

        return view('assignment.show')->with('assignment', $assignment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {

        // get assignment with components, sorted by due date for column labels
        
        //$artifacts = Artifact::where('user_id', Auth::User()->id)->where('assignment_id', $assignment->id)->get();

        //dd($artifacts);

        $assignment = Assignment::with(['components' => function ($query) use ($assignment) {
            $query->where('assignment_id', $assignment->id)->orderBy('date_due');
            },'comments'])->findOrfail($assignment->id);
        
        //dd($assignment)->comments();

        $checklist = DB::table('components')->leftjoin('artifacts', function ($join) use ($assignment) {

                        $join->on('components.id', '=', 'artifacts.component_id')
                             ->where('artifacts.user_id', '=', Auth::User()->id); // This eliminates matches, not records
                        })

                        ->where('components.assignment_id', '=', $assignment->id)

                        ->orderBy('components.date_due', 'ASC')
                        ->select(
                         'artifacts.id AS artifactID',
                         'components.assignment_id AS assignmentID',
                         'components.id AS componentID', 
                         'components.title AS componentTitle',
                         'components.date_due AS componentDateDue',
                         'artifacts.artifact_thumb AS artifactThumb',
                         'artifacts.artifact_path AS artifactPath',
                         'artifacts.is_published AS is_published',
                         'artifacts.created_at AS artifactCreatedAt')->get();                         

                         //dd($checklist);

            



        return view('assignment.show')->with([
                                 'assignment' => $assignment,
                                 //'artifacts' => $artifacts,
                                 //'students' => $students,
                                 'checklist' => $checklist
                                 //'student_checklist' => $student_checklist
                                 ] );


    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function showTeacherView(Assignment $assignment)
    {

        // get assignment with components, sorted by due date for column labels
        
        if (Auth::User()->hasRole('teacher'))

            echo 'teacher';

        else 

            echo 'student';       
        
        //dd($users);

        $assignment = Assignment::with(['components' => function ($query) use ($assignment) {
            $query->where('assignment_id', $assignment->id)->orderBy('date_due');
            }])->findOrfail($assignment->id);
        
        //dd($assignment)->components();

        
        $checklist = DB::table('components')->leftjoin('artifacts', function ($join) use ($assignment) {

                        $join->on('components.id', '=', 'artifacts.component_id');            
                        
                        })

                        ->where('components.assignment_id', '=', $assignment->id)
                        ->orderBy('components.date_due', 'ASC')
                        ->select(
                         'artifacts.id AS artifactID',
                         'components.assignment_id AS assignmentID',
                         'components.id AS componentID', 
                         'components.title AS componentTitle',
                         'components.date_due AS componentDateDue',
                         'artifacts.artifact_thumb AS artifactThumb',
                         'artifacts.artifact_path AS artifactPath',
                         'artifacts.created_at AS artifactCreatedAt')->get();                         

                        dd($checklist);



        return view('assignment.show')->with([
                                 'assignment' => $assignment,
                                 'artifacts' => $artifacts,
                                 //'students' => $students,
                                 'checklist' => $checklist
                                 //'student_checklist' => $student_checklist
                                 ] );


    }

    public function grid(Assignment $assignment)
    {

        $projects = Project::with('user')
        ->where('assignment_id', $assignment->id )->get();

        //dd($projects);

        return view('assignment.grid')->with(['projects' => $projects, 
                                    'assignment' => $assignment ]);

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
        'description' => 'required'
        ]);

        // get form input data
        
        $assignment->title = $request->input('title');
        $assignment->description = $request->input('description');
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
