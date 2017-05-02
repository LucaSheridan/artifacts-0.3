<?php

namespace App\Http\Controllers;

use App\Project;
use App\Assignment;
use App\Component;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         //$assignments = Assignment::all(); 
         $assignments = Assignment::pluck('title', 'id');

         // maybe add independent project to end of assignment array

        return view('project.create', ['assignments' => $assignments] );

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
        'assignment' => 'required',
        'title' => 'required',
        'user_id' => 'required',  
        ]);

        // get form input data for Project

        $assignment = $request->input('assignment');
        $title = $request->input('title');
        $user_id = $request->input('user_id');

        // set and persist project information to database

        $project = New Project;
        
        $project->assignment_id = $assignment;
        $project->title = $title;
        $project->user_id = $user_id;
        $project->save();

        return redirect()->action('HomeController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        
        $project = Project::with('artifacts')->findorFail($id);

        $assignment = Assignment::with('components')->find($project->assignment_id);

        $checklist = DB::table('components')
            ->leftjoin('artifacts', 'components.id', '=', 'artifacts.component_id')
            ->select('components.assignment_id AS assignmentID',
                     'components.id AS componentID', 
                     'components.title AS componentTitle',
                     'components.date_due',
                     'artifacts.id AS artifactID',
                     'artifacts.artifact_thumb AS artifactThumb',
                     'artifacts.artifact_path AS artifactPath',
                     'artifacts.component_id AS artifactComponentID',
                     'artifacts.created_at')
            ->where('components.assignment_id','=', $project->assignment_id )
            ->orderBy('componentID')->get();

            //dd($checklist);

    return view('project.show', ['project' => $project, 
                                 'assignment' => $assignment,
                                 'checklist' => $checklist] );
                                }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $project = Project::with('artifacts')->find($id);

        // We should get an array of image files related to
        // the media records to use in deletion. this
        // would be vastly more efficient.

        foreach ($project->artifact as $artifact)

        { 
            $artifact->delete();
        }
    
            $project->delete();

        return redirect()->action('HomeController@index');
    }
    
    /**
     * Add a media file to the specified resource.
     *
     * @param  \App\Project  $id
     * @return \Illuminate\Http\Response
     */


    public function addArtifact($id)
    {

        $project = Project::with('assignment')->findOrFail($id);

        $assignment = Assignment::with('components')->find($project->assignment_id);

        $components = Component::all()->where('assignment_id', '=', $project->assignment_id)->pluck('title','id');

            
            //dd($assignments);


    return view('artifact.create', ['project' => $project,
                                    'assignment' => $assignment,
                                    'components' => $components]
                        );

            }
}
