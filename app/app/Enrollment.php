<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    /**
    * Get the course associated with the enrollment.
    */
    public function course(){
        return $this->belongsTo('App\Course');   
    }
    
    /**
    * Get the user associated with the enrollment.
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
        
}
