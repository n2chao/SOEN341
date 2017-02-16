@extends('layouts.app')

@section('extra-content')
    <script type="text/javascript" src="/js/course.js"></script>
      <div class="col-md-9">
        <div id="course-panel" class="panel panel-default">
          <div class="panel-heading">Course Selection</div>
          <div class="panel-body">
            <div class="form-group">
              <p class="add"> Add your courses to find your matching study buddy now!&nbsp;&nbsp;<input type="button" value="Add Course" onClick="addRow('dataTable')" class="btn btn-success btn-sm "  /></p>
            </div>
            <form class="form-horizontal" action="" class="course_selection" method="POST">
              <fieldset class="row2"><table id="dataTable" class="form" border="0px">
                  <tbody>
                  <tr>
                    <p>
                    <td>
                      <div class="form-group">
                        <label for="course_name" class="col-md-4 control-label">Course Name: </label>
                        <div class="col-md-6">
                          <input id="course_name" type="text" placeholder="i.e SOEN341" class="form-control" name="course_name" value="{{ old('course_name') }}" required autofocus>
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
                    Buddy Me Up!
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection
@include('common')
