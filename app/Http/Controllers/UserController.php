<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment;
use App\User;
use App\Section;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('sites','sections','roles')->get();

        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //$user = User::with('artifacts')->findOrFail($user->id);

        $user = User::with(['artifacts' => function ($query) {
            $query->where('is_published', '=', true);
        }])->findOrFail($user->id);

        //dd($user);

        // $artifacts = Artifact::where('user_id', Auth::User()->id)
        //                     ->where('is_published', 1)
        //                     ->get();

        //$section = Section::where('user_id', $user->id)->first();

        //$assignments = Assignment::where('section_id', $section)->get();

        //dd($section);
        //dd($assignments);

        return view('user.show')->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with('user', $user);
    }

     /**
    * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // create valiadator
        $this->validate($request, [
        'firstName' => 'required|max:255',
        'lastName' => 'required|max:255',
        //'email'=>'required|email|unique:users,email,'.$user->id,
        'email'=>'unique:users,email,'.$user->id,

        ]);

        // get form input data and persist to database
        $user = User::findOrfail($user->id);

        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');
        $user->save();
        
        return redirect()->action('UserController@index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        return view('user.delete')->with('user', $user);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->action('UserController@index');
    }
}
