<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{

	//protected $dateFormat = 'U';
    
   
   public function user()
    
    {
         return $this->belongsTo('App\User');
    }

    public function getFullNameAttribute() 

    {
    
    return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    
    }

   public function assignment()
    
    {
        return $this->belongsTo('App\Assignment');
    }

    public function component()
    
    {
         return $this->belongsTo('App\Component');
    }

     public function artist()
    
    {
         return $this->belongsTo('App\User');
    }

      public function collections()
    
    {
         return $this->belongstoMany('App\Collection')->withPivot('position');
    }

    
}


