@extends('layouts.app')

@section('extra-content')
	<div class="col-md-9">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Find a Study Buddy</div>
					<div class="panel-body">
						<form method="GET" action="/requests/create">
							<div class="radio">
								<h4>Select a Course</h4>
                                @foreach ($courses as $course)
                                    <label><input name="course" value="{{$course->id}}" type="radio">{{ $course->code }}</label></br>
                                @endforeach
							</div>
							<button class="btn btn-default" type="submit" value="selection">Next</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@include('common')
