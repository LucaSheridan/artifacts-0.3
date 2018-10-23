<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Artifact;
use App\User;


class Collection extends Model
{

	//protected $dateFormat = 'U';
    
   
     public function curators()
    
    {
         return $this->belongsToMany(User::class)->withPivot('position');
    }

    public function artifacts()
    {
        return $this->belongsToMany(Artifact::class)->withPivot('position')->orderBy('position', 'desc');
    }

}