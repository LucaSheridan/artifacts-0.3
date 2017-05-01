<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user()
    {
            return $this->belongsTo('App\User');

    }

    public function artifacts()
    {
             return $this->hasMany('App\Artifact');
             //return $this->hasManyThrough('App\Assignment', 'App\Artifact');
    }

    public function assignment()
    {
            return $this->belongsto('App\Assignment');

    }        

	public function components()
    {
    		return $this->hasManyThrough('App\Assignment', 'App\Component');

    }         

}
