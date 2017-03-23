<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
    * Get all enrollments associated with the course.
    */
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }
    
    /**
    * Get all users associated with the course.
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'enrollments');
    }
}
