<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body','user_id'
    ];

     /**
     * A comment belongs  to an artifact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function artifact()
    {
        return $this->belongsTo(Artifact::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
