<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'section_id',
    ];

     public function components()
    {
            return $this->hasMany('App\Component');
    }

     public function section()
    {
            return $this->belongsTo('App\Section');
    }

     public function artifacts()
    {
            return $this->hasMany('App\Artifact');
    }

}
