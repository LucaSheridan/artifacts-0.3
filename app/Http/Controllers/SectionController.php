<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment;
use App\Component;
use App\Artifact;
use App\Section;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;


class SectionController extends Controller
{
    
    public function classProgressReport(Section $section)
    
    {
         
        // get this section assignments and set to an array
        $assignments = Assignment::where('section_id', $section->id)
                                 ->where('active', true)
                                 ->pluck('id')->toArray();
        //dd($assignments);
        
        $roster = User::whereHas('roles', function ($query) { 
            $query->where('name', 'like', 'student');
                })->whereHas('sections', function ( $query ) use($section) {
            $query->where('id', $section->id );
            })->orderBy('lastName','asc')->get()
            ->pluck('id')->toArray();
        
        //dd($roster);

       foreach ($roster as $rosterspot) {
    
            $checklist = Artifact::with('assignment','user')

            ->rightjoin('components', function ($join) use ($rosterspot, $assignments) {

            $join->on('components.id', '=', 'artifacts.component_id')
                
                 ->where('artifacts.user_id', '=', $rosterspot);
                // This eliminates matches, not records

                })

                ->whereIn('components.assignment_id', $assignments)
                ->orderBy('components.id', 'asc')
               
                ->select(
                 'artifacts.user_id AS user_id',
                 'artifacts.id AS artifact_id',
                 'components.assignment_id AS assignment_id',
                 'components.id AS component_id', 
                 'components.title AS component_title',
                 'components.date_due AS component_due',
                 'artifacts.artifact_thumb AS artifact_thumb',
                 'artifacts.artifact_path AS artifact_path',
                 'artifacts.created_at AS artifact_created')
                 //'artifacts.is_published AS is_published')
                 ->get();

                 dd($checklist);                      

                }

        return view('section.classProgressReport')
               ->with(compact('assignments','checklist','$roster'));
    
    }
    public function progressReport(Section $section, User $user)
    
    {
         
        // get this section assignments and set to an array
        $assignments = Assignment::where('section_id', $section->id)
                                 ->where('active', true)
                                 ->pluck('id')->toArray();

        //dd($assignments);

            $checklist = Artifact::with('assignment')

            ->rightjoin('components', function ($join) use ($user, $assignments) {

            $join->on('components.id', '=', 'artifacts.component_id')
                
                 ->where('artifacts.user_id', '=', $user->id);
                // This eliminates matches, not records

                })

                ->whereIn('components.assignment_id', $assignments)
                ->orderBy('components.id', 'asc')
               
                ->select(
                 'artifacts.id AS artifact_id',
                 'components.assignment_id AS assignment_id',
                 'components.id AS component_id', 
                 'components.title AS component_title',
                 'components.date_due AS component_due',
                 'artifacts.artifact_thumb AS artifact_thumb',
                 'artifacts.artifact_path AS artifact_path',
                 'artifacts.created_at AS artifact_created')
                 //'artifacts.is_published AS is_published')
                 ->get();

                 //dd($assignmentChecklist);                      

        return view('section.progressReport')
               ->with(compact('assignments','checklist','user'));
    
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $sections = Section::with('users','site')->get();

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

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $section->active = true;
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
        $roster = User::whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
        })->orderBy('lastName','asc')->get();
        
        return view('section.show', compact('section','teacher','roster', 'assignments'));
    }

    


    /**
     * Display an individual student assignment
     *
     * @param  \App\Section $section
     * @param  \App\Assignment $assignment
     * @param  \App\User $student
     * @return \Illuminate\Http\Response
     */
    public function StudentAssignmentDetailView(Section $section, Assignment $assignment, User $user)
    {
        
        $assignmentChecklist = DB::table('components')->leftjoin('artifacts', function ($join) use ($assignment, $user) {

            $join->on('components.id', '=', 'artifacts.component_id')
                 ->where('artifacts.user_id', '=', $user->id); // This eliminates matches, not records

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
                 'artifacts.created_at AS artifactCreatedAt',
                 'artifacts.is_published AS is_published')
                 ->get();                         

        return view('section.StudentAssignmentDetailView', 
               compact('user', 'section', 'assignment', 'assignmentChecklist'));
    }

    /**
     * Display grid of all published artifacts associated with this assignment.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function ViewClassAssignment(Section $section, Assignment $assignment)
    {
        
        $roster = User::whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
        })->orderBy('lastName','asc')->get();
        
        $students = User::with(['artifacts' => function ($query)  use($assignment) {
        $query->where('is_published', '=', true)
              ->where('assignment_id', '=', $assignment->id);
        }])->whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
        })->get();

        $section = Section::findOrFail($section->id);
        $assignment = Assignment::findOrFail($assignment->id);

        return view('section.ViewClassAssignment')->with(compact('roster','incomplete','students','assignment', 'section'));
     }

         /**
     * Display grid of all published artifacts associated with this assignment.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function ViewClassAssignmentGrid(Section $section, Assignment $assignment)
    {
        
        $students = User::with(['artifacts' => function ($query)  use($assignment) {
        
                            $query
                                  ->where('is_published', '=', true)
                                  ->where('assignment_id', '=', $assignment->id)
                                  ->orderBy('component_id.date','asc');
                            }])

                        ->whereHas('roles', function ($query) { 
        
                            $query->where('name', 'like', 'student');
                            })

                        ->whereHas('sections', function ( $query ) use($section) {
        
                            $query->where('id', $section->id );
                            })

                        ->orderBy('lastName','asc')->get();
        
        //dd($roster);

        // $students = User::with(['artifacts' => function ($query)  use($assignment) {
        // $query->where('is_published', '=', true)
        //       ->where('assignment_id', '=', $assignment->id);
        // }])->whereHas('roles', function ($query) { 
        // $query->where('name', 'like', 'student');
        //     })->whereHas('sections', function ( $query ) use($section) {
        // $query->where('id', $section->id );
        // })->get();

        // $section = Section::findOrFail($section->id);
        // $assignment = Assignment::findOrFail($assignment->id);

        //
        // return view('section.ViewClassAssignmentGrid')->with(compact('roster','incomplete','students','assignment', 'section'));

        return view('section.ViewClassAssignmentGrid')->with(compact('students','assignment', 'section'));
     }

    /**
     * Show the form for editing the Section.
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

    /**
     * Display grid of all published artifacts associated with this assignment.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function StudentXray(Section $section, User $user)
    {
        
        $assignments = Assignment::where('section_id', $section->id)->get();

        ($assignments);

        return view('section.StudentXray')->with(compact('assignments', 'section', 'user'));
     }

     public function AssignmentComponent(Section $section, Assignment $assignment, Component $component)
    {
        
        // $section = Input::get('section_selection');
        // $assignment = Input::get('assignment_selection');
        // $component = Input::get('component_selection');

        $sections =  Auth::User()->sections()->get()->pluck('label','id');

        $assignments = Assignment::where('section_id', $section->id)->get()->pluck('title','id');

        $components = Component::where('assignment_id', $assignment->id)->get()->pluck('title','id');
    
        $students = User::with(['artifacts' => function ($query) use($component) {
        $query->where('component_id', '=', $component->id);
        }])->whereHas('roles', function ($query) { 
        $query->where('name', 'like', 'student');
            })->whereHas('sections', function ( $query ) use($section) {
        $query->where('id', $section->id );
        })->get()->sortBy('lastName');

        //dd($students);

        return view('section.assignment.component.show')
               ->with(compact('sections', 'section', 'assignments', 'assignment', 'components', 'component', 'students'));
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
     * Display an individual student assignment
     *
     * @param  \App\Section $section
     * @param  \App\Assignment $assignment
     * @param  \App\User $student
     * @return \Illuminate\Http\Response
     */
    public function StudentAssignmentProgressView(Section $section, Assignment $assignment, User $user)
    {
        
        $assignmentChecklist = DB::table('components')->leftjoin('artifacts', function ($join) use ($assignment, $user) {

            $join->on('components.id', '=', 'artifacts.component_id')
                 ->where('artifacts.user_id', '=', $user->id); // This eliminates matches, not records

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
                 'artifacts.created_at AS artifactCreatedAt',
                 'artifacts.is_published AS is_published')
                 ->get();                         

        return view('section.StudentAssignmentProgressView', 
               compact('user', 'section', 'assignment', 'assignmentChecklist'));
    }

    /////
    /////
    
}
