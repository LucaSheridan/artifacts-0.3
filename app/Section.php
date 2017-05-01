<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

        /**
     * A section may associate with a users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

     public function assignments()
    {
            return $this->hasMany('App\Assignment');

    }
}
