<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    /**
    * Meetings (and Attendances) that occured in the past are soft deleted.
    * $dates is used for soft deleting, see documentation.
    */
    protected $dates = ['deleted_at'];

    /**
    * Get the user associated with the attendance.
    */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
    * Get the meeting associated with the attendance.
    */
    public function meeting(){
        return $this->belongsTo('App\Meeting');
    }

    /**
    * Get the SOFT DELETED meeting associated with the attendance.
    */
    public function meetingTrashed(){
        return $this->meeting()->withTrashed()->first();
    }
}
