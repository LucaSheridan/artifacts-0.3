<?php

namespace App\Http\Controllers;

use Auth;
use App\Artifact;
use App\Component;
use App\Comment;
use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

// testing extension($path) for image rotate
use Illuminate\Filesystem\Filesystem;


class ArtifactController extends Controller
{

     /**
     * Add Comment to Artifact.
     *
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request, Artifact $artifact)
       
        {
        

        $artifact = Artifact::find($artifact->id);

        $component_title = $artifact->component->title;

        //dd($artifact);

        $comment = $artifact->comments()->create([
                // 'body' => $component_title.' -> '.$request->input('body'),
                'body' => $request->input('body'),
                'user_id' => Auth::User()->id
        ]);

        //return action('assignment.show')->with('assignment', $assignment_id);

        //return redirect()->action('AssignmentController@show', $artifact->assignment_id);

        return redirect()->action('SectionController@StudentAssignmentProgressView', [
            'assignment' => $artifact->assignment_id, 
            'user' => $artifact->user_id, 
            'section' => $artifact->assignment->section->id ]);


        }


        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
       
        {
        
        $artifacts = Artifact::get();

        return view('artifact.index')->with('artifacts', $artifacts);

        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create(Request $request, Component $component)
   
        {
        return view('artifact.create')->with('component', $component);
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
        
            'file' => 'required|image',
            'user_id' => 'required',
            'assignment_id' => 'required',
            'component_id' => 'required',
            ]);

            // get form input data
            $user_id = $request->input('user_id');
            $assignment_id = $request->input('assignment_id');
            $component_id = $request->input('component_id');

            // get file input data as object
            $image = $request->file('file');

/////////// get real path to file in temp directory
            $realPath = $request->file('file')->getRealPath();
      
            // set image and thumbnail filenames
            $fileName = time();
            $imageFileName = $fileName.'.'. $image->getClientOriginalExtension();
            $thumbFileName = $fileName.'.thumb.'. $image->getClientOriginalExtension();

            // // create a new Image/Intervention instance
            // $image = Image::make($image)->orientate();

/////////// create a new Image/Intervention instance from file system
            
            $image = Image::make($realPath)->orientate();

            // set storage
            $s3 = \Storage::disk('s3');

            // set paths
            $imagePath = 'uploads/' . $imageFileName;
            $thumbPath = 'uploads/' . $thumbFileName;
            
            // apply image transformations

                //check for portrait or landscape orientation
                $width = $image->width();
                $height = $image->height();

                if ($height >= $width) { $orientation = "portrait"; }
                else { $orientation = "landscape"; }

                //resize logic based on image orientation
            
                if ($orientation == 'portrait')

                { 
                    // Initial resize to 1000 pixels
                    $image->resize(null, 1600, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    })->interlace()->encode('jpg', 85);
                    // Save image to Amazon S3
                    $s3->put($imagePath, $image->__toString(), 'public');

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(200, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    // Crop and encode thumbnail as jpg
                    })->crop(200, 200)->interlace()->encode('jpg', 85);
                    // Save thumbnail to Amazon S3
                    $s3->put($thumbPath, $image->__toString(), 'public');
                }

                else 
                
                {    
                    // Initial resize to 1000 pixels
                    $image->resize(1600, null, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    })->interlace()->encode('jpg', 85);
                    // Save image to Amazon S3
                    $s3->put($imagePath, $image->__toString(), 'public');

                    // Resize to 200 pixels for thumnail generation
                    $image->resize(null, 200, function ($constraint) { 
                    $constraint->aspectRatio();
                    $constraint->upsize();
                    // Crop and encode thumbnail as jpg
                    })->crop(200, 200)->interlace()->encode('jpg', 85);
                    // Save thumbnail to Amazon S3
                    $s3->put($thumbPath, $image->__toString(), 'public');
                }

            // Good for smaller files... $s3->put($path, file_get_contents($image), 'public');
            // Better for big files...  $s3->put($path, fopen($image, 'r+'), 'public');

            // set and persist information to database
            $artifact = New Artifact;
        
            $artifact->user_id = $user_id;
            $artifact->assignment_id = $assignment_id;
            $artifact->component_id = $component_id;
            $artifact->is_published = false;
            $artifact->is_visible = true;
            $artifact->artifact_path = $imagePath;
            $artifact->artifact_thumb = $thumbPath;
            $artifact->title = 'Untitled';
            $artifact->medium = '';
            $artifact->description = '';
            $artifact->dimensions_height = '';
            $artifact->dimensions_width = '';
            $artifact->dimensions_depth = null;
            $artifact->dimensions_units = 'cm';
            $artifact->save();
            
            flash('An artifact has been successfully added to this assignment!', 'success');

            return redirect()->action('AssignmentController@show', $artifact->assignment_id);

        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function show(Artifact $artifact)
    {
        return view('artifact.show')->with('artifact', $artifact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function edit(Artifact $artifact)
    {
        
        return view('artifact.edit')->with('artifact', $artifact);
    }


    /**
     * Published the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function publish (Request $request, Artifact $artifact)
    {
        
         // create valiadator
        $this->validate($request, [
        'title' => 'required',
        'medium' => 'required',
        'dimensions_height' => 'required',
        'dimensions_width' => 'required',
        //'dimensions_depth' => 'required',
        'dimensions_units' => 'required',
        'description' => 'required|max:500'
        //'description' => 'max:500'

        ]);
        
        $artifact = Artifact::findOrFail($artifact->id);

        // get form input data
        $artifact->title = $request->input('title');
        $artifact->medium = $request->input('medium');
        $artifact->dimensions_units = $request->input('dimensions_units');
        $artifact->dimensions_height = $request->input('dimensions_height');
        $artifact->dimensions_width = $request->input('dimensions_width');
        $artifact->dimensions_depth = $request->input('dimensions_depth');
        $artifact->description = $request->input('description');

        $artifact->is_published = true;
        $artifact->is_visible = true;

        $artifact->save();

        $artifacts = Artifact::where('is_published', 1)
                             ->where('user_id', Auth::User()->id)->get();    

        //flash('An artifact has been successfully published to your portfolio!', 'success');

        return view('home')->with('artifacts', $artifacts);
    }


    /**
     * Published the specified resource.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function unpublish (Artifact $artifact)
    {
        
        $artifact = Artifact::findOrFail($artifact->id);

        $artifact->is_published = false;
        $artifact->is_visible = true;
        $artifact->save();

        $artifacts = Artifact::where('is_published', 1)
                             ->where('user_id', Auth::User()->id)->get(); 

        //flash('An artifact has been successfully removed from your portfolio!', 'success');

        return view('home')->with('artifacts', $artifacts);
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
        
        // create valiadator
        $this->validate($request, [
        'title' => 'required',
        'medium' => 'required',
        'dimensions_height' => 'required',
        'dimensions_width' => 'required',
        //'dimensions_depth' => 'required',
        'dimensions_units' => 'required',
        'description' => 'required|max:500'

        ]);

        // get form input data
        $artifact->title = $request->input('title');
        $artifact->medium = $request->input('medium');
        $artifact->dimensions_units = $request->input('dimensions_units');
        $artifact->dimensions_height = $request->input('dimensions_height');
        $artifact->dimensions_width = $request->input('dimensions_width');
        $artifact->dimensions_depth = $request->input('dimensions_depth');
        $artifact->description = $request->input('description');

        $artifact->save();

        flash('Artifact updated successfully!', 'success');

        return redirect()->action('ArtifactController@show', $artifact->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function delete(Artifact $artifact)
    {
     
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
    
    // Delete artifact record from database
        
        $artifact->delete();

    // Set confirmation message

        flash('Artifact deleted successfully!', 'danger');

    // Redirect to Assignent

    return redirect()->action('AssignmentController@show', $artifact->assignment_id);
    }

    /**
     * Rotate the specified artifact.
     *
     * @param  \App\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function rotate(Artifact $artifact, $degrees)
    {

    // get artifact from database

            $artifact = Artifact::findOrFail($artifact->id);

    //get file extension from database

            $originalExtension = str_after($artifact->artifact_path,'.');
                        
    // create new Image/Intervention instances

            $rotatedImage = Image::make(Storage::disk('s3')->url($artifact->artifact_path));
            $rotatedThumb = Image::make(Storage::disk('s3')->url($artifact->artifact_thumb));
            
    // Rotate by degree and re-encode.
            
            $rotatedImage->rotate($degrees)->encode();
            $rotatedThumb->rotate($degrees)->encode();
            //return $rotatedImage->response();

    // set image and thumbnail filenames
           
            $fileName = time();
            $rotatedImagePath = 'uploads/'.$fileName.'.'. $originalExtension;
            $rotatedThumbPath = 'uploads/'.$fileName.'.thumb.'.$originalExtension;

    // Set Storage path
     
            $s3 = \Storage::disk('s3');

    // Save image to storage
            
             $s3->put($rotatedImagePath, $rotatedImage->__toString(), 'public');
             $s3->put($rotatedThumbPath, $rotatedThumb->__toString(), 'public');

    //save old storage paths for deletion

             $old_artifact_path = $artifact->artifact_path;
             $old_thumb_path = $artifact->artifact_thumb;

    //save new storage paths to database

            $artifact->artifact_path = $rotatedImagePath;
            $artifact->artifact_thumb = $rotatedThumbPath;
            $artifact->save();

    // Delete old image files from storage
            
            File::delete($old_thumb_path);
            File::delete($old_artifact_path);

            flash('Image rotated', 'success');

            return redirect()->action('ArtifactController@show', $artifact->id);
    }
    
}
