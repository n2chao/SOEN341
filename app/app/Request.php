<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
    * Get the course associated with the meeting.
    * One-to-One relationship.
    */
    public function course(){
      return $this->hasOne('App/Course');
    }

    /**
    * Get all the users associated with the meeting request.
    * Many-to-Many relationship.
    */
    public function users(){
      return $this->belongsToMany('App\User', 'invites');
    }

    /**
    * Return all meeting invitations.
    */
    public function invites(){
      return $this->hasMany('App\Invite');
    }

    /**
    * Return the sender of the meeting request.
    * @return User
    */
    public function sender(){
        $id = $this->invites->where('sender', true)->first()->user_id;
        return \App\User::find($id);
    }

    /**
     * Return the receiver of the meeting request.
     * @return User
     */
    public function receiver(){
        $id = $this->invites->where('sender', false)->first()->user_id;
        return \App\User::find($id);
    }
}
