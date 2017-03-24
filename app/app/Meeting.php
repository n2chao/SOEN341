<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;
    /**
    * Meetings that occured in the past are soft deleted.
    * $dates is used for soft deleting, see documentation.
    */
    protected $dates = ['deleted_at'];

    /**
    * Get the course associated with the meeting.
    * One-to-One relationship.
    */
    public function course()
    {
        return $this->hasOne('App/Course');
    }

    /**
    * Get all the users associated with the meeting.
    * Many-to-Many relationship.
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'attendances');
    }

    /**
    * Return all meeting attendances.
    */
    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    /**
    * Return all attendances including SOFT DELETED.
    */
    public function attendancesTrashed(){
        return $this->hasMany('App\Attendance')->withTrashed();
    }
}
