<div id="course-panel" class="panel panel-default">
  <div class="panel-heading">Current Classes</div>
  <div class="panel-body">

    @php
    $user = Auth::user();
    $userCoursesArray = $user->enrollments()->pluck('course_id')->toArray();  //create array of authenticated user's courses
    $userCourses = array();
    foreach($userCoursesArray as $userCourse){
        $course = App\Course::where('id', '=', $userCourse)->first();
        array_push($userCourses, $course['code']);
    }

    @endphp

    @if(empty($userCourses))
      <p>You are not enrolled in any courses</p>
    @else
      <table class="table table-hover">
        @foreach($userCourses as $userCourse)
          <tr>
            <td class="course_row">
              {{$userCourse}}
            </td>
            <td>
              <a href="{{action('EnrollmentController@dropCourse', $userCourse)}}">
                <input type="button" value="Remove" class="btn btn-danger btn-sm "/>
              </a>
            </td>
          </tr>
        @endforeach
      </table>
    @endif

  </div>
</div>
