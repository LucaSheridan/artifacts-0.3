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
}
