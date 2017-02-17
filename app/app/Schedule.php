<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    public function users(){
    	return $this->hasOne('App\User');
    }
}
