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

    public function projects()
    {
            return $this->hasMany('App\Project');
    }

     public function components()
    {
            return $this->hasMany('App\Component');
    }

}
