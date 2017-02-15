@extends('layouts.app')

@section('extra-content')
	<div class="col-md-9">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Choose an Instructor to Meet Wtih</div>
					<div class="panel-body">
						<h3>Choose a Teacher or TA</h3>


						<form id="instructor-names" method="GET" action="/choosetime">

							{{csrf_field()}}

							<div class="radio">
								<h4>Teachers</h4>
								@foreach ($teachers as $teacher)
									<label><input id="teacher-name" name="instructor" value="{{$teacher}}" type="radio">{{ $teacher }}</label></br>
								@endforeach

								<h4>Teaching Assistants</h4>
								@foreach ($tas as $ta)
									<label><input id="ta-name" name="instructor" value="{{$ta}}" type="radio">{{ $ta }}</label></br>
								@endforeach
							</div>

							<button class="btn btn-default" type="submit" value="selection" name="instructor-names-next">Next</button>

						</form>


					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection
@include('common')