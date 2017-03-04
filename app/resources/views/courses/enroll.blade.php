@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <!-- Available courses-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <label>MOCK_UI : Available Courses</label>
                    @foreach ($allCourses as $course_code => $course_id)
                        <p>{{ $course_code}} (course_id = {{$course_id}}) </p>
                    @endforeach
                    @if(empty($courses))
                        <p>No avaliable courses</p>
                    @endif
                    </div>
            </div>

            <!-- Enrolled courses-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <label>MOCK_UI : Enrolled Courses</label>
                    @foreach ($courses as $course_code => $course_id)
                        <p>{{ $course_code}} (course_id = {{$course_id}}) </p>
                    @endforeach
                    @if(empty($courses))
                        <p>You are not enrolled in any courses</p>
                    @endif
                    </div>
            </div>
            
            <!-- Add/Drop Courses FORM -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST" action="/courses">
                        {{csrf_field()}}
                      <div class="form-group">
                        <label for="course_id">MOCK_UI : Add Course</label>
                        <p><input type="text" class="form-control" id="add_course_ids" placeholder="Enter course_id" name="add_course_ids[1]" required></p>
                        <p><input type="text" class="form-control" id="add_course_ids" placeholder="Enter course_id" name="add_course_ids[2]"></p>
                        <label for="drop_course_id">MOCK_UI : Delete Course</label>
                        <p><input type="text" class="form-control" id="drop_course_ids" placeholder="Enter course_id" name="drop_course_ids[1]" ></p>
                        <p><input type="text" class="form-control" id="drop_course_ids" placeholder="Enter course_id" name="drop_course_ids[2]"></p>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            
            <!-- Developer notes-->
            <div class="panel panel-default">
                <div class="panel-body">
                    <label>MOCK_UI : Dev Notes</label>
                        <p>This UI serves only to test the back-end</p>
                        <p>Add and delete courses using the course_id</p>
                        <p>Validation must ensure that : </p>
                        <ul>
                          <li>user cannot enroll to course_id that does not exist</li>
                          <li>user cannot enroll to the same course_id more than once</li>
                          <li>user cannot submit any fields besides array of course_ids</li>
                        </ul>
                    <p>Also is it just me or the footer doesn't stick to the bottom when scrolling down a long page?</p>
                    </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
