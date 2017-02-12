@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                <div class="panel-heading">Courses</div>-->

                <div class="panel-body">
                    <form method="POST" action="/courses">
                        {{csrf_field()}}
                      <div class="form-group">
                        <label for="course_id">course_id</label>
                        <input type="number" class="form-control" id="course_id" placeholder="Enter course_id" name="course_id">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
