<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

	public function getDates()
	{
		return ['created_at','updated_at','date_due'];
	
	}

    public function assignment()
    {
    	return $this->belongsTo('App\Assignment');

    }
}
