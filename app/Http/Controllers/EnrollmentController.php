<?php

namespace App\Http\Controllers;

use App\Section;
use App\User;
use Auth;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
  
    /**
     * Show the form for enrolling a student in a new class.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()

    {
      return view('enroll');
    }

    
    /**
     * Attach new section to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create valiadator

        $this->validate($request, [
        
            'code' => 'required|exists:sections,code',

            ]);

                $code = $request['code'];

                // Use code to look up section and site

                $section = Section::where('code', $code)->first();

                // Enroll student in section

                Auth::User()->sections()->attach($section->id);
                
                // Enroll student at site

                Auth::User()->sites()->sync($section->site_id);

                flash('Class added successfully!', 'success');

        return redirect()->route('home');

    }

   
}
