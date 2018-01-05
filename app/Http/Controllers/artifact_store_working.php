public function store(Request $request)
        
        {
             // create valiadator
        
        $this->validate($request, [
        
            'file' => 'required',
            'user_id' => 'required',
            'assignment_id' => 'required',
            'component_id' => 'required',

            ]);

        // get file input data as object
        $file = $request->file('file');

        // get form input data
        $user_id = $request->input('user_id');
        $assignment_id = $request->input('assignment_id');
        $component_id = $request->input('component_id');

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
        
        $artifact->user_id = $user_id;
        $artifact->assignment_id = $assignment_id;
        $artifact->component_id = $component_id;
        $artifact->is_published = false;
        $artifact->is_visible = false;
        $artifact->artifact_path = $media_path;
        $artifact->artifact_thumb = $thumb_path;
       
        $artifact->title = 'untitled';
        $artifact->medium = 'unspecified';
        $artifact->description = 'Type your comments and reflections here';
        $artifact->dimensions_height = 'unspecified';
        $artifact->dimensions_width = 'unspecified';
        $artifact->dimensions_depth = null;
        $artifact->dimensions_units = 'inches';

        $artifact->save();

        flash('An artifact has been successfully added to this assignment!', 'success');

        return redirect()->action('AssignmentController@show', $assignment_id);
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
            'assignment_id' => 'required',
            'component_id' => 'required',

            ]);

        // get file input data as object
        $file = $request->file('file');

        // get form input data
        $user_id = $request->input('user_id');
        $assignment_id = $request->input('assignment_id');
        $component_id = $request->input('component_id');

        //dd($user_id);
        //dd($assignment_id);
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
        
        $artifact->user_id = $user_id;
        $artifact->assignment_id = $assignment_id;
        $artifact->component_id = $component_id;
        $artifact->is_published = false;
        $artifact->is_visible = false;
        $artifact->artifact_path = $media_path;
        $artifact->artifact_thumb = $thumb_path;
       
        $artifact->title = 'untitled';
        $artifact->medium = 'unspecified';
        $artifact->description = 'Type your comments and reflections here';
        $artifact->dimensions_height = 'unspecified';
        $artifact->dimensions_width = 'unspecified';
        $artifact->dimensions_depth = null;
        $artifact->dimensions_units = 'inches';

        $artifact->save();

        flash('An artifact has been successfully added to this assignment!', 'success');

        return redirect()->action('AssignmentController@show', $assignment_id);
        }