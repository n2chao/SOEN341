@extends('layouts.app')

@section('extra-content')
	<div class="col-md-9">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Choose a Meeting Time</div>
					<div class="panel-body">
						<h3>Select a Time</h3>
						<form id="instructor-names" method="GET" action="#">
							<div class="radio">
								<h4>Times that match your free time.</h4>
								@foreach ($availMatch as $match)
									<label><input type="radio" name="match">{{ $match }}</label></br>
								@endforeach
								<h4>Other times the instructor is available.</h4>
								<p>{TIMES GO HERE}</p>
							</div>
							<button class="btn btn-default" type="submit" name="instructor-names-next">Add to Schedule</button>
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection
@include('common')