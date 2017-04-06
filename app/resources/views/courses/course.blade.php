@extends('layouts.app')
@section('extra-content')
    <!-- Selectize.js CSS -->
    <link href="{{ url('/js/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
    <!-- jquery delivered via content delivery network - testing -->
    <script
      src="https://code.jquery.com/jquery-1.10.2.min.js"
      integrity="sha256-C6CB9UYIS9UJeqinPHWTHVqh/E1uhG5Twh+Y5qFQmYg="
      crossorigin="anonymous"></script>
    <!-- Selectize.js for smart search -->
    <script type="text/javascript" src='{{ url("/js/selectize/js/standalone/selectize.min.js") }}'></script>
    <script type="text/javascript" src="/js/course.js"></script>
      <div class="col-md-9">
          <!-- test SELECT box -->
          <!-- <meta name="csrf_token" content="{{ csrf_token() }}" /> -->
          <!-- <select id="searchbox" name="q" placeholder="Search..." class="form-control"></select> -->

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

        <div id="course-panel" class="panel panel-default">
          <div class="panel-heading">Add New Courses</div>
          <div class="panel-body">
            <form class="form-horizontal course_selection" action="/course" method="POST">
              <p>Number of classes:
                <input type="button" value="+" onClick="addRow('dataTable')" class="btn btn-success btn-sm" name="plus"/>
                <input type="button" value="-" onClick="deleteRow('dataTable')" class="btn btn-danger btn-sm "/>
              </p>
              {{csrf_field()}}
              <fieldset class="row2">
                <table id="dataTable" class="form" border="0px">
                  <tbody>
                  <tr>
                    <p>
                    <td>
                      <div class="form-group">
                        <label for="course_name_0" class="col-md-4 control-label">Course Name: </label>
                        <div class="col-md-6">
                            <select id="course_name_0" type="text" placeholder="i.e SOEN341" class="form-control" name="add_course_ids[0]" value="{{ old('course_name') }}">

                          <!-- <input id="course_name" type="text" placeholder="i.e SOEN341" class="form-control" name="add_course_ids[0]" value="{{ old('course_name') }}"> -->
                        </div>
                        <input type="button" value="Remove" onClick="deleteRow('dataTable')" class="btn btn-primary btn-xs"  />
                      </div>
                    </td>
                    </p>
                  </tr>
                  </tbody>
                </table>
              </fieldset>
              <div class="form-group">
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary ">
                    Add Courses
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection
@include('common')
