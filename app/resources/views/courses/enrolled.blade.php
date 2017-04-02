<div id="course-panel" class="panel panel-default">
  <div class="panel-heading">Current Classes</div>
  <div class="panel-body">

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
