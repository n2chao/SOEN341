<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//required to use Auth
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    //see dependency injection (import models by overriding constructor)
    protected $users;
    //mass assignment protection
    protected $fillable = ['course_id'];
    
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
    * Responds to POST /courses
    */
    public function store() {
        $user = Auth::user();  //get authenticated user 
        //validate course_id (is course_id valid, is user already authenticated)
        $user->courses()->attach(request('course_id')); //attach course_id to user
        return redirect('/home');
        
    }
    
    /**
    * Responds to GET /courses/enroll
    */
    public function create(){
        return view('courses.enroll');
        
    }
}
