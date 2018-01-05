<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artifact;
use App\Section;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     `*
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $artifacts = Artifact::where('user_id', Auth::User()->id)
                            ->where('is_published', 1)
                            ->get();

        return view('home', array('artifacts' => $artifacts));
    }

    
}
