@extends('layouts.app')

@section('content')
 
<head>
  <title>Buddy Up - Course Selection</title>

  <link rel="stylesheet" type="text/css" href="/css/course.css"/>
  <script type="text/javascript" src="/js/course.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <div id="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="course-panel" class="panel panel-default">
          <div class="panel-heading">Course Selection</div>

          <div class="panel-body">

            <div class="form-group">
              <p class="add"> Add your courses to find your matching study buddy now!&nbsp;&nbsp;<input type="button" value="Add Course" onClick="addRow('dataTable')" class="btn btn-success btn-sm "  /></p>
            </div>


            <form class="form-horizontal" action="" class="course_selection" method="POST">


              <fieldset class="row2">


                <table id="dataTable" class="form" border="0px">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>


</body>


@endsection
