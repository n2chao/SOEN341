<?php

namespace App\Http\Traits;

use Illuminate\Validation\Rule;         //required for request validation
use Illuminate\Http\Request;
use Validator;
use Auth;
use Log;
use App\Enrollment;
use App\Course;
use App\User;

trait EnrollmentTraits
{
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
      return redirect('courses/course');
  }

}
