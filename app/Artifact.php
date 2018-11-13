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

   
    /**
     * A post can have many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
   

    //







      /**
     * Add a comment to the post.
     *
     * @param array $attributes
     */
    public function addComment($attributes)
    {
        $comment = (new Comment)->forceFill($attributes);
        $comment->user_id = auth()->id();
        return $this->comments()->save($comment);
    }

    
}


