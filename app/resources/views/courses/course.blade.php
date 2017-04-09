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
                    <td align="right">
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
          <div class="panel-heading">Add New Courses
              <div class="pull-right" align="center">
                  <input type="button" value="+" onClick="addRow('dataTable')" class="btn btn-success btn-sm" name="plus"/>
                  <input type="button" value="-" onClick="deleteRow('dataTable')" class="btn btn-danger btn-sm"/>
              </div>
          </div>
          <div class="panel-body">
                <form class="form-horizontal course_selection" action="/course" method="POST">
              {{csrf_field()}}
                <table id="dataTable" class="table">
                  <tr>
                    <td>
                        <input id="course_name_0" type="text" style="width: 190px;" placeholder="i.e. SOEN341" name="add_course_ids[0]" value="{{ old('course_name') }}"/>
                    </td>
                    <td align="right">
                        <p id="course_name_0_description"></p>
                    </td>
                  </tr>
                </table>
                <div id="ui_error" class="alert alert-warning alert-dismissable fade in" style="display:none;">
                    <button type="button" class="close" onclick="$('.alert').hide()">&times;</button>
                    <p id="ui_error_message"></p>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary ">
                    Add Courses
                  </button>
                </div>
              </div>
            </form>
            @if (count($errors))
                <div class='form-group'>
                    <div class='alert alert-danger alert-dismissable'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
          </div>
        </div>
      </div>
@endsection
@include('common')
