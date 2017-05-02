<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Artifact;
use App\Component;
use App\Project;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\File;


class ArtifactController extends Controller
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
    
    public function create($project_id)
   
        {
          //
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
        
            'file' => 'required',
            'user_id' => 'required',
            'project_id' => 'required',
            'assignment_id' => 'required',

            'component' => 'required',

            ]);


        // get file input data as object
        $file = $request->file('file');

        //dd($request)->input;

        // get form input data
        $user_id = $request->input('user_id');
        $project_id = $request->input('project_id');
        $assignment_id = $request->input('assignment_id');
        $component_id = $request->input('component');

        //dd($component_id);

        // set destination path
        $destination = "storage/uploads/".$user_id;
        

        // check if destination paths already exists

                if (!File::exists($destination)) { 

                // If not, create user directory

                File::makeDirectory($destination,  $mode = 0777, $recursive = true); 

                }

                if (!File::exists($destination.'/thumb')) { 

                // If not, create user directory

                File::makeDirectory($destination.'/thumb',  $mode = 0777, $recursive = true); 

                }

        // get original name of uploaded file
        
        $originalName = $file->getClientOriginalName();

        // set new name
        $newName = rand(100, 999).'-'.$originalName;
                        
        // set location
        $media_path = $destination."/".$newName;
        
        // set location of thumbnail
        $thumb_path = $destination."/thumb/".$newName;

        // create a new Image/Intervention instance
        $image = Image::make($request->file('file'))->orientate();

        //check for portrait or landscape orientation
        $width = $image->width();
        $height = $image->height();

        if ($height >= $width) { $orientation = "portrait"; }
        else { $orientation = "landscape"; }

            //resize logic based on image orientation
            
            if ($orientation == 'portrait')

                { 
                    // Initial resize to 800 pixels
                    $image->resize(null, 800, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();

                    });

                    // Save image
                    $image->save($media_path);

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(200, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();

                    });

                    //Crop and save thumbnail
                    $image->crop(200, 200)->save($thumb_path);        
                }

            else 
                
                { 
                    
                    // Initial resize to 800 pixels
                    $image->resize(800, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();

                    });

                    // Save image
                    $image->save($media_path);

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(null, 200, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();

                    });

                    //Crop and save thumbnail
                    $image->crop(200, 200)->save($thumb_path);     
                }

        // set and persist information to database



        $artifact = New Artifact;
        
        //$artifact->assignment = $assignment;
        $artifact->user_id = $user_id;
        $artifact->project_id = $project_id;
        $artifact->assignment_id = $assignment_id;
        $artifact->component_id = $component_id;
        //$artifact->component_title = $component_title;
        $artifact->artifact_path = $media_path;
        $artifact->artifact_thumb = $thumb_path;
        
        $artifact->save();

        return redirect()->action('ProjectController@show', $artifact->project_id);

        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function show(Artifact $artifact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function edit(Artifact $artifact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artifact $artifact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function delete(Artifact $artifact)
    {
        //$artifact = Artifact::find($artifact);

        return view('artifact.delete')->with('artifact', $artifact);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artifact $artifact)
    {

        // Delete image files from storage

        File::delete($artifact->artifact_thumb);
        File::delete($artifact->artifact_path);

        $artifact->delete();

        flash('Artifact deleted successfully!', 'danger');

        return redirect()->action('ProjectController@show', $artifact->project_id);


    }
}
