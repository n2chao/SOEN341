<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//required to use Auth
use Illuminate\Support\Facades\Auth;
//required for request validation
use Illuminate\Validation\Rule;
use Validator;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Contracts\Validation\Validator;


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
    * Returns for alowing user to add and drop courses.
    * Responds to GET /courses/enroll
    */
    public function create(){
        return view('courses.enroll');
    }
    
    /**
    * Adds courses to user's enrollment.
    * Responds to POST /courses
    */
    public function store() {
        $user = Auth::user();  //get authenticated user
        $this->addCourses(request('add_course_id'));
        $this->dropCourses(request('drop_course_id'));

        return redirect('/courses');  
    }
    
    private function addCourses(array $data){
        $user = Auth::user();  //get authenticated user
        Validator::make($data, [
            'add_course_id' => [
                'unique', 
                'required',             //required
                'integer',              //is an integer
                'exists:courses,id',    //exists in courses table, column id
            ],
        ]);
        //only add course if user is not already enrolled
        $courses = $user->courses->pluck('id')->toArray();  //create array of authenticated user's courses
        $add = array_diff($data, $courses);
        $add = array_unique($add);
        $user->courses()->attach($add); //attach array of course_id to user
        
    }
    
    private function dropCourses(array $data){
        $user = Auth::user();  //get authenticated user
        Validator::make($data, [
            'drop_course_id' => [
                'required',             //required
                'integer',              //is an integer
                'exists:courses,id',    //exists in courses table, column id
            ],
        ]);
        //only add course if user is not already enrolled
        $courses = $user->courses->pluck('id')->toArray();  //create array of authenticated user's courses
        $drop = array_intersect($data, $courses);
        $drop = array_unique($drop);
        $user->courses()->detach($drop); //detach array of course_id from user
//        Session::flash('message', 'Successfully deleted courses!');
        
    }
    
    /**
    * Drops class from user's enrollment.
    * Responds to DELETE /courses
    */
//    public function destroy(Request $request) {
//        dd($request);
//        $user = Auth::user();  //get authenticated user 
//        //validate array of course_id
//        $data = request('course_id');
//        dd($data);
//        Validator::make($data, [
//            'course_id' => [
//                'required',             //required
//                'integer',              //is an integer
//                'exists:courses,id',    //exists in courses table, column id
//            ],
//        ]);
//        //only drop course if user is currently enrolled
//        $courses = $user->courses->pluck('id')->toArray();  //create array of authenticated user's courses
//        $drop = array_intersect($data, $courses);
//        $user->courses()->detach($drop); //detach array of course_id from user
//        Session::flash('message', 'Successfully deleted courses!');
//        return redirect('/courses');  
//    }
}
