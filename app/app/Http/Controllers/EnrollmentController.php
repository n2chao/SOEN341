<?php

namespace App\Http\Controllers;

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
    //see dependency injection (import models by overriding constructor)
    protected $users;
    //mass assignment protection
    protected $fillable = ['add_course_ids'];

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
        return view('courses.course');
    }

    /**
    * Returns for allowing user to add and drop courses.
    * Responds to GET /courses/enroll
    */
    public function create()
    {
        return view('courses.course');
    }

    /**
    * Adds courses to user's enrollment.
    * Responds to POST /courses
    */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'add_course_ids.*' => 'required'
            ]);
        $user = Auth::user();  //get authenticated user
        //call addCourses and dropCourses helper methods
        $this->addCourses(array_filter(request('add_course_ids')));
        return redirect()->back();
    }

    public function messages()
    {
      return [
          'add_course_ids.*.required' => 'A title is required',
          ];
    }

    /**
    * Helper function. Add courses specified in $data.
    * @param $data array of courses the user has added
    */
    private function addCourses(array $data)
    {
        $user = Auth::user();  //get authenticated user
        //$input is a single course code ie soen341
        foreach($data as $input){
            $rules = Array(
                      'code' => 'required|exists:courses,code',
                      'course_id' => Rule::unique('enrollments')->where('user_id', $user->id)
                    );
            //get course_id corresponding to course code ie soen341
            $course_id = Course::where('code', $input)->first()->id;
            $v = validator::make(array('code'=>$input, 'course_id'=>$course_id), $rules);
            $failed = array();

            if($v->passes()){
                $user->courses()->attach($course_id);
            } else {
                # code for validation failure
                array_push($failed, $input);
            }
            //validation error
            if(count($failed) != 0){
                //create error message for courses that were not added
                $failed_courses = "Courses not added:";
                foreach($failed as $code){
                    $failed_courses = $failed_courses. '\n' . $code;
                }
             }
            //end validation error
        }
    }

    /**
    * Helper function. Drop courses specified in $data.
    * @param $data array of course_id
    */
    public function dropCourse($code){
        $user = Auth::user();  //get authenticated user
        //get course_id corresponding to course code ie soen341
        $course_id = Course::where('code', $code)->first()->id;
        $user->courses()->detach($course_id);  //detach course
        return redirect()->back();
    }


}
