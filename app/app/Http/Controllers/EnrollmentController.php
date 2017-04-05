<?php

namespace App\Http\Controllers;

use App\Http\Traits\EnrollmentTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    //required to use Auth
use Illuminate\Validation\Rule;         //required for request validation
use Validator;
use App\User;
use App\Course;
use App\Enrollment;
use Log;

class EnrollmentController extends Controller
{
  use EnrollmentTraits;
    //see dependency injection (import models by overriding constructor)
    protected $users;
    protected $userCourses;
    //mass assignment protection
    protected $fillable = ['add_course_id', 'drop_course_id'];

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
        return view('courses/course');
    }

    /**
    * Returns for allowing user to add and drop courses.
    * Responds to GET /courses/enroll
    */
    public function create()
    {

        // $user = Auth::user();
        // //get array of all available courses
        // $allCourses = \App\Course::all()->pluck('id', 'code');
        // //get array of all enrolled courses
        // //pass $allCourses and $courses array to view
        // return view('courses.course', compact('courses', 'allCourses'));

        return view('courses.course');
    }

    /**
    * Adds courses to user's enrollment.
    * Responds to POST /courses
    */
    public function store()
    {
        $user = Auth::user();  //get authenticated user
        //call addCourses and dropCourses helper methods
        $this->addCourses(request('add_course_ids'));
        //$this->dropCourses(request('drop_course_ids'));
        return redirect('courses/course');
    }


}
