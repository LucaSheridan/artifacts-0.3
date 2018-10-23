<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artifact;
use App\Assignment;
use App\Component;
use App\Collection;
use App\Section;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;


class CollectionController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::with('curators','artifacts')->get();

        return view('collection.index')->with('collections', $collections);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {

        $collection  = Collection::with('artifacts')->findOrfail($collection->id);
            
        return view('collection.show')->with('collection', $collection);
    }   

    /**
     * Create the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function create(Artifact $artifact)
    {
       
        return view('collection.create')->with('artifact', $artifact);
    }  

      /**
     * Store the specified resource.
     *
     * @param  \App\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // create valiadator
        
        $this->validate($request, [
        'title' => 'required|max:255',
        
        // Here is where we would enforce labels.

        ]);

          //dd($request->title);
          //dd($request->curator_id);
          //dd($request->artifact_id);

          $collection = new Collection;
          
          //set title from request 
          $collection->title = $request->title;

          //get artifact from request
          
          $artifact = Artifact::find($request->artifact_id)->first();

          $collection->cover_thumb = $artifact->artifact_thumb;
          $collection->save();

          // attach artifact to collection
          $collection->artifacts()->attach($artifact, ['position' => 1]);
          
          // determine highest position in collection from intermediate tables 'position' column

          if ( Auth::User()->collections()->exists()) {
    
            $lastPosition = DB::table('collection_user')->where('user_id', Auth::User()->id)->pluck('position')->max();
          }

          else { $lastPosition = 0;
        
          }
    
          // determine the 'position' of the collection 

          $newPosition = $lastPosition + 1;
          
          $collection->curators()->attach(Auth::User()->id, ['position' => $newPosition]);
         
          return redirect()->action('CollectionController@show', $collection->id);

    }   
}