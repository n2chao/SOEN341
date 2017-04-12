@extends('layouts.app')

@section('extra-content')

<div class="row">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Find a Study Buddy</div>
					<div class="panel-body">
						<form method="GET" action="/requests/create">
							<div class="radio">
								@if( !$courses->isempty() )
									<h4>Select a Course</h4>
									@foreach($courses as $course)
											<label><input name="course" value="{{$course->id}}" type="radio">{{ $course->code }}</label></br>
									@endforeach
									<button class="btn btn-default" type="submit" value="selection">Next</button>
								@else
									<p>You need to <a href="/courses/course">enroll</a> in a course to be able to study.</p>
								@endif
							</div>
							@if (count($errors))
								<div class='form-group'>
									<div class='alert alert-danger'>
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								</div>
							@endif
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@include('common')
