<?php

namespace App\Http\Controllers;

use Auth;
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
         


         // This will eventually break with multiple classes

        $section = (Auth::User()->sections()->first());
                 
        $projects = Project::where('user_id', Auth::User()->id)->pluck('assignment_id')->toArray();
        
        $assignments = Assignment::where('section_id', $section->id)->get();

        $assignments = $assignments->except($projects)->pluck('title','id');

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
        'user_id' => 'required',  
        ]);

        // get form input data for Project

        $assignment = $request->input('assignment');
        
        $user_id = $request->input('user_id');

        // set and persist project information to database

        $project = New Project;
        
        $project->assignment_id = $assignment;
        $project->title = 'Untitled';
        $project->medium = 'Unknown';
        $project->dimensions_height = 'Unknown';
        $project->dimensions_width = 'Unknown';
        $project->dimensions_depth = 'Unknown';
        $project->dimensions_units = 'Unknown';
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

        //$matchThese = ['components.assignment_id' => $project->assignment_id];

            // $checklist = DB::table('components') 
            // ->leftjoin('artifacts', 'components.id', '=', 'artifacts.component_id')
            // ->select('components.assignment_id AS assignmentID',
            //          'components.id AS componentID', 
            //          'components.title AS componentTitle',
            //          'components.date_due',
            //          'components.is_primary AS isPrimary',
            //          'artifacts.id AS artifactID',
            //          'artifacts.artifact_thumb AS artifactThumb',
            //          'artifacts.artifact_path AS artifactPath',
            //          'artifacts.component_id AS artifactComponentID',
            //          'artifacts.created_at',
            //          'artifacts.user_id AS user_id')
            // ->where(['components.assignment_id' => $project->assignment_id])
            // ->orderBy('componentID')
            // ->get();

            $checklist = DB::table('components') 
            ->select('components.assignment_id AS assignmentID',
                     'components.id AS componentID', 
                     'components.title AS componentTitle',
                     'components.date_due',
                     'components.is_primary AS isPrimary',
                     'artifacts.id AS artifactID',
                     'artifacts.artifact_thumb AS artifactThumb',
                     'artifacts.artifact_path AS artifactPath',
                     'artifacts.component_id AS artifactComponentID',
                     'artifacts.created_at',
                     'artifacts.user_id AS user_id')
            ->leftjoin('artifacts', function ($join) use ($project) {

            $join->on('components.id', '=', 'artifacts.component_id');
            //$join->where('artifacts.user_id', '=', Auth::User()->id) ;
            $join->where('artifacts.user_id', '=', $project->user_id );
            
            })  
            
            ->where(['components.assignment_id' => $project->assignment_id])
            ->orderBy('componentID')
            ->get();

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
       return view('project.edit')->with('project', $project);
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
        
        // create valiadator
        $this->validate($request, [
        'title' => 'required',
        'medium' => 'required',
        'dimensions_height' => 'required',
        'dimensions_width' => 'required',
        //'dimensions_depth' => 'required',
        'dimensions_units' => 'required',

        ]);

        // get form input data
        
        $project->title = $request->input('title');
        $project->medium = $request->input('medium');
        $project->dimensions_units = $request->input('dimensions_units');
        $project->dimensions_height = $request->input('dimensions_height');
        $project->dimensions_width = $request->input('dimensions_width');
        $project->dimensions_depth = $request->input('dimensions_depth');
        
        $project->save();

        flash('Project updated successfully!', 'success');

        return redirect()->action('ProjectController@show', $project->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function delete(Project $project)
    {
        return view('project.delete')->with('project', $project);
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

        foreach ($project->artifacts as $artifact)

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

        return view('artifact.create', ['project' => $project,
                                    'assignment' => $assignment,
                                    'components' => $components]
                        );

            }
}
