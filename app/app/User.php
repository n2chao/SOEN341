<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Get enrolled courses for user.
     */
    public function courses() {
        return $this->belongsToMany('App\Course', 'enrollments');
    }
    
    /**
    * Get all enrollments for the user.
    */
    public function enrollments() {
        return $this->hasMany('App\Enrollment');
    }
    
    /**
    * Get the schedule of the user.
    */
    public function schedule(){
        return $this->hasOne('App\Schedule');
    }
    /**
    * Check if a user is enrolled in a give course.
    */
//    public function isEnrolled('App\Course' as $course){
//        
//    }

}
