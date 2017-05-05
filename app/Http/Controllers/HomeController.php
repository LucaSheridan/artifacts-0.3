<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Component;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
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
        // $projects = Project::with('artifacts','assignment')
        //                         ->where('user_id', Auth::User()->id)
        //                         ->orderBy('created_at', 'desc')->get();

        $projects = Project::with('artifacts','assignment.components')
                                   ->where('user_id', Auth::User()->id)
                                   ->orderBy('created_at', 'desc')->get();
        //dd($projects);

        return view('home', array('projects' => $projects));
    }
}
