<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user may have multiple sites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

     public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

     public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function artifacts()
    {
        return $this->hasMany(Artifact::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

     public function scopeTeacher($query)
    {
        return $query->hasRole('teacher');
    }

     public function scopeStudent($query)
    {
        return $query->hasRole('student');
    }
}
