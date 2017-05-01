<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{

	//protected $dateFormat = 'U';
    
    public function project()
    
    {
        return $this->belongsTo('App\Project');
    }

}
