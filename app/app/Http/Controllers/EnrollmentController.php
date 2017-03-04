<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//required to use Auth
use Illuminate\Support\Facades\Auth;
//required for request validation
use Illuminate\Validation\Rule;
use Validator;

class EnrollmentController extends Controller
{
    //see dependency injection (import models by overriding constructor)
    protected $users;
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
        $user = Auth::user();
        //the User dependency is injected so courses relationship can be used
        return $user->courses;
    }
    
    /**
    * Returns for allowing user to add and drop courses.
    * Responds to GET /courses/enroll
    */
    public function create(){
        $user = Auth::user();
        //get array of all available courses
        $allCourses = \App\Course::all()->pluck('id', 'code');
        //get array of all enrolled courses
        $courses = $user->courses->pluck('id', 'code')->toArray();
        //pass $allCourses and $courses array to view
        return view('courses.enroll', compact('courses', 'allCourses'));
    }
    
    /**
    * Adds courses to user's enrollment. 
    * Responds to POST /courses
    */
    public function store() {
        $user = Auth::user();  //get authenticated user
        //call addCourses and dropCourses helper methods
        $this->addCourses(request('add_course_ids'));
        //$this->dropCourses(request('drop_course_ids'));
        return redirect('/course');
    }
    
    /**
    * Helper function. Add courses specified in $data.
    * @param $data array of course_id
    */
    private function addCourses(array $data){
        $user = Auth::user();  //get authenticated user

        foreach($data as $input){
            $rules = Array('code' => 'required|exists:courses,code|unique:enrollments,course_id');
            $v = validator::make(array('code'=>$input), $rules);
            $failed = array();

            if( $v->passes() ) {
                # code for validation success!
                $courses = $user->courses->pluck('id')->toArray();  //create array of authenticated user's courses
                $add = array_diff($data, $courses);     //array of courses to be added
                $add = array_unique($add);
                foreach ($add as $course){
                    if(!in_array($course, $courses)){      //if user is not enrolled
                        $user->courses()->attach($course);  //attach course
                    }
                }
            } else {
                # code for validation failure
                array_push($failed, $input);
            }
            if(count($failed) != 0){
                $failed_courses = "Courses not added:";
                foreach($failed as $code){
                    $failed_courses = $failed_courses. '\n' . $code;
                }
                echo '<script language="javascript">';
                echo 'alert('. $failed_courses .')';
                echo '</script>';
            }
        }

/*
        $v = Validator::make($data, [    //rule validation
            'add_course_ids' => [
                'unique',
                'required',
                'integer',
                'exists:courses,code',    //exists in courses table, column id
            ],
        ]);
        if( $v->passes() ) {
            # code for validation success!
            //only add course if user is not already enrolled
            $courses = $user->courses->pluck('id')->toArray();  //create array of authenticated user's courses
            $add = array_diff($data, $courses);     //array of courses to be added
            $add = array_unique($add);
            foreach ($add as $course){
                if(!in_array($course, $courses)){      //if user is not enrolled
                    $user->courses()->attach($course);  //attach course
                }
            }
        } else {
            # code for validation failure
        }
*/
    }
    
    /**
    * Helper function. Drop courses specified in $data.
    * @param $data array of course_id
    */
    private function dropCourses(array $data){
        $user = Auth::user();  //get authenticated user
        Validator::make($data, [    //rule validation
            'drop_course_ids' => [
                'required',
                'integer',
                'exists:courses,id',    //exists in courses table, column id
            ],
        ]);
        //only add course if user is not already enrolled
        $courses = $user->courses->pluck('id')->toArray();  //create array of authenticated user's courses
        $drop = array_intersect($data, $courses);   //array of courses to be dropped
        $drop = array_unique($drop);
        foreach ($drop as $course){
             if(in_array($course, $courses)){       //if user is enrolled
                $user->courses()->detach($course);  //detach course
            }
        }        
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
//        return redirect('/courses');  
//    }
}
