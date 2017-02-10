<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//required to use Auth
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    //see dependency injection (import models by overriding constructor)
    protected $users;
    
    /**
     * Override default constructor, inject the User dependency.
     */
    public function __construct(UserController $users)
    {
        $this->users = $users;
    }
    
    /*
    * Responds to GET /courses
    */
    public function index(){
        $user = Auth::user();
        //the User dependency is injected so courses relationship can be used
        return $user->courses;
    }
        
    /**
    * Responds to GET /courses/enroll
    */
    public function create($course_id){
        $user = Auth::user();
        $user->courses()->attach($course_id);
    }
    
    public function store() {
        //prevent cross site request forgery
        //ensures that post is sent to the correct endpoint
        //compares token against what it has in the session
        {{csrf_field()}}
        dd(request()->all());
        $user = Auth::user();
        
        //create a new enrollment
        $enrollment = new \App\Enrollment;
        $enrollment->user_id = ...
        $enrollment->course_id = request('body');
        //save it to the database
        $enrollment->save();
        //redirect to the home page
        return redirect('/home');
        
        //why not do the following
        //$user->courses->attach($course_id);
        
        //from laracast form request data and csrf
    }
}
