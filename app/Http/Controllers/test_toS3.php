 {

        // create valiadator

        $this->validate($request, [
        
            'file' => 'required',
            //'user_id' => 'required',
            //'assignment_id' => 'required',
            //'component_id' => 'required',
        
        ]);

            // get file input data as object
            $image = $request->file('file');

            // apply image transformations

            //dd($image); 

            //fake form input data
            $user_id = Auth::User()->id;
            $assignment_id = 1;
            $component_id = 22;

            // get form input data
            $user_id = $request->input('user_id');
            $assignment_id = $request->input('assignment_id');
            $component_id = $request->input('component_id');

            
            $imageFileName = time() . '.' . $image->getClientOriginalExtension();
        
            //dd($imageFileName);

            //$image_normal = $image;
            //$image_thumb = Image::make($image_normal)->crop(100,100);
        
            //$image_thumb = $image_thumb->stream();

            //dd($image_normal);
            //dd($image_thumb);

            $s3 = \Storage::disk('s3');

            $path = 'uploads/' . $imageFileName;

            // working - good for smaller files
            //$s3->put($path, file_get_contents($image), 'public');

            // working - better for big files - need to set Size in Config?
            $s3->put($path, fopen($image, 'r+'), 'public');

            // set and persist information to database

            $artifact = New Artifact;
        
            $artifact->user_id = $user_id;
            $artifact->assignment_id = $assignment_id;
            $artifact->component_id = $component_id;
            $artifact->is_published = false;
            $artifact->is_visible = true;
            $artifact->artifact_path = $path;
            //$artifact->artifact_thumb = $thumb_path;
       
            $artifact->title = 'untitled';
            $artifact->medium = 'unspecified';
            $artifact->description = 'Type your comments and reflections here';
            $artifact->dimensions_height = 'unspecified';
            $artifact->dimensions_width = 'unspecified';
            $artifact->dimensions_depth = null;
            $artifact->dimensions_units = 'inches';
            $artifact->save();
    
        // Set path

        //$path = 'artifacts-0.6/';

        //dd($path);

        //Storage::disk('s3')->put('/public', $image_normal->__toString());
        // Storage::disk('s3')->put($path.'thumbnails/'.$file, $image_thumb->__toString());

        // $image = Image::make($request->file('file'));
        // $image->encode('jpg');
        
        //dd($image);

        //$path = Storage::disk('s3')->put('/public/items/test.jpg', $image->__toString());
        //$path = Storage::disk('s3')->put('/public/items/test.jpg', $image->stream('jpg','90'));


        //$path = Storage::disk('s3')->putFile('artifacts-0.6', $image, 'public');
        
        //$img = Image::make($request->file('file'))->stream('jpg','90');

        //dd($imageg);

        //Storage::disk('s3')->putFile('artifacts-0.6', $image, 'public');



        //Storage::disk('s3')->putFile('artifacts-0.3', $img->stream());

        //Storage::disk('s3')->putFile('artifacts-0.3', $img, 'public');

        //$path = $request->file('file')->store('artifacts-0.6', 's3', 'public');
        //$path = $image_normal->store('artifacts-0.6', 's3', 'public');

        //$path = Storage::disk('s3')->putFile('../'. $request->file('file'), 'public');


        flash('Artifact added to Amazon S3 successfully!', 'success');

        return view('artifact.S3result')->with('path', $path);