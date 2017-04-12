@extends('layouts.app')

@section('extra-content')
<!-- INSTRUCTOR CHOOSE -->
    <div class="row">
      <div class="col-md-12">
        <div class="profile-content">
				<div class="panel panel-default">
					<div class="panel-heading">Choose an Instructor to Meet Wtih</div>
					<div class="panel-body">

						<!-- <form id="instructor-names" method="POST" action="/instructorMeeting"> -->
						<form id="instructor-names" method="GET" action="/choosetime">
						<div class='row'>
							<div class='col-md-6'>
								<div class="radio">

									<h4>Teachers</h4>
									@forelse ($teachers as $teacher_name => $teacher_id)
										<label><input id="teacher-name" name="instructor" value="{{$teacher_id}}" type="radio">{{ $teacher_name }}</label></br>
                  @empty
                      <p>No teacher is available</p>
                  @endforelse

								</div>
							</div>

							<div class='col-md-6'>
								<div class='radio'>
									<h4>Teaching Assistants</h4>
									@forelse ($tas as $ta_name => $ta_id)
										<label><input id="ta-name" name="instructor" value="{{$ta_id}}" type="radio">{{ $ta_name }}</label></br>
                  @empty
                    <p>No Teaching Assistant is available</p>
                  @endforelse
								</div>
							</div>
							</div>
							<div class='row'>
								<div class='col-md-3'>
                  @if(!$teachers->isempty()||!$tas->isempty())
  									<button class="btn btn-default" type="submit" value="selection" name="instructor-names-next">Next</button>
                  @endif
                </div>
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
<!-- END INSTRUCTOR CHOOSE -->
@endsection
@include('common')
