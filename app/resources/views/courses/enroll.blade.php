@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST" action="/courses">
                        {{csrf_field()}}
                      <div class="form-group">
                        <label for="course_id">TEST : Add Course</label>
                        <input type="number" class="form-control" id="add_course_ids" placeholder="Enter course_id" name="add_course_ids[1]" required>
                        <input type="number" class="form-control" id="add_course_ids" placeholder="Enter course_id" name="add_course_ids[2]">
                        <label for="drop_course_id">TEST : Delete Course</label>
                        <input type="number" class="form-control" id="drop_course_ids" placeholder="Enter course_id" name="drop_course_ids[1]" required>
                        <input type="number" class="form-control" id="drop_course_ids" placeholder="Enter course_id" name="drop_course_ids[2]">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@endsection
