<?php

namespace App\Http\Controllers;

use App\Site;
use App\User;
use Auth;
use App\Role;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $sites = Site::with('users.roles','sections')->orderBy('name')->paginate(10);
        
        return view('site.index')->with(compact('sites','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
      return view('site.create');
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
        
            'name' => 'required',

            ]);

        $site = New Site;
        $site->name = $request->input('name');
        $site->save();

        flash('Site created successfully!', 'success');

        return redirect()->action('SiteController@index');

    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //$site = Site::with('users.roles','sections');

        $site = Site::with('users.roles','sections')->where('id', $site->id)->first();
        
        // $site = Site::with('users.roles','sections')->where('id', $site->id)->first();

        $sections = $site->sections->sortBy('code');

        return view('site.show')->with(compact('site','sections','users','roles'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        return view('site.edit')->with('site', $site);

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        // create valiadator
        $this->validate($request, [
        'name' => 'required',
        ]);

        // get form input data
        
        $site->name = $request->input('name');
        $site->save();

        flash('Site updated successfully!', 'success');

        return redirect()->action('SiteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function delete(Site $site)
    {
        return view('site.delete')->with('site', $site);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {

        $site = Site::find($site);

        $site->delete();

        flash('Site deleted successfully!', 'danger');

        return redirect()->action('SiteController@index');
    }
}
