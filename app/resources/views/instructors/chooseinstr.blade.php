@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Choose an Instructor to Meet Wtih</div>
			<div class="panel-body">
				<h3>Choose a Teacher or TA</h3>
				<form id="instructor-names" method="GET" action="/user">
					<div class="radio">
						<h4>Teachers</h4>
						@foreach ($teachers as $teacher)
							<label><input type="radio" name="optradio">{{ $teacher }}</label></br>
						@endforeach
						<h4>Teaching Assistants</h4>
						@foreach ($tas as $ta)
							<label><input type="radio" name="optradio">{{ $ta }}</label></br>
						@endforeach
					</div>
					<button class="btn btn-default" type="submit" name="instructor-names-next">Next</button>
				</form>
			</div>
		</div>
	</div>
@endsection