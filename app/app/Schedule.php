<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
      'user_id','freetime','creatssed_at','updated_at'
    ];

    public function user()
    {
    	return $this->hasOne('App\User');
    }
}
