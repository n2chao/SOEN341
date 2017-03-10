<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    /**
    * Get the course associated with the meeting.
    * One-to-One relationship.
    */
    public function course(){
        return $this->hasOne('App/Course');
    }

    /**
    * Get all the users associated with the meeting.
    * Many-to-Many relationship.
    */
    public function users(){
        return $this->belongsToMany('App\User', 'attendances');
    }

    /**
    * Return all meeting attendances.
    */
    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
}
