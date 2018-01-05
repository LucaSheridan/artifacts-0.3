       /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function grid(Section $section, Assignment $assignment)
    {
        

        //dd($section);
        //dd($assignment);

        // $assignments = Assignment::with('components','artifacts')
        // ->orderBy('title', 'ASC')
        // ->get();

        $students = User::whereHas('roles', function ($query) { 

                                                      $query->where('name', 'like', 'student');})
        
                        ->whereHas('sections', function ( $query ) use($section) { 

                                                      $query->where('id', $section->id );
        })->get();


        //dd($students);

        //$teacher = User::find($section->teacher_id);

        $assignment = Assignment::with('components')->findOrFail($assignment->id);

        //dd($assignment);

        //$artifacts = Artifact::with('users')->where('assignment_id', Auth::User()->id)
                                            //->where('assignment_id', $assignment->id)->get();

        // $users = User::with('artifacts')->whereHas('roles', function ($query) { 
                 
        //         $query->where('name', 'like', 'student');
        //         })->whereHas('sections', function ( $query ) use($section) {
        
        //         $query->where('id', $section->id );
        //         })->get();

        // $progressList = DB::table('components')->leftjoin('artifacts', function ($join) use ($assignment) {

        //                 $join->on('components.id', '=', 'artifacts.component_id');

        //                 })

        //                 ->where('components.assignment_id', '=', $assignment->id)
        //                 ->orderBy('components.date_due', 'ASC')
        //                 ->select(
        //                  'artifacts.id AS artifactID',
        //                  'components.assignment_id AS assignmentID',
        //                  'components.id AS componentID', 
        //                  'components.title AS componentTitle',
        //                  'components.date_due AS componentDateDue',
        //                  'artifacts.artifact_thumb AS artifactThumb',
        //                  'artifacts.user_id AS userName',
        //                  'artifacts.artifact_path AS artifactPath',
        //                  'artifacts.created_at AS artifactCreatedAt')->get();                         

        //                  dd($progressList);

        //dd($students);
        //dd($assignment);
        
        // return view('section.grid')->with([

        //     'students' => $students,
        //     'assignment' => $assignment,
        //     'section' => $section]);

        return view('section.grid')->with(['section' => $section, 'assignment' => $assignment, 'students' => $students]);


    }