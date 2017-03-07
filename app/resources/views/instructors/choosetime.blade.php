@extends('layouts.app')

@section('extra-content')
	<div class="col-md-9">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Choose a Meeting Time</div>
					<div class="panel-body">
						<!-- Form for changing the week -->
						<form id="changeWeek" method="GET" action="/choosetime">
							{{csrf_field()}}

							<div class="row">
								<div class="col-md-3">
									<p id="newWeek">From: <?php echo date("D, M d, Y H:i:s", $week[0])?></p>
								</div>
								<div class="col-md-3">
									<p id="newWeek">To: <?php echo date("D, M d, Y H:i:s", $week[1])?></p>
								</div>
							</div>

							<input type="hidden" name="instructor" value="{{$instructor->id}}">
							<input type="hidden" name="weekStart" value="{{$week[0]}}">
							<input type="hidden" name="weekEnd" value="{{$week[1]}}">

							<div>
								<button type="btn btn-default" name="prevWeek" value="prevWeek">Previous Week</button>
								<button type="btn btn-default" name="nextWeek" value="nextWeek">Next Week</button>
							</div>
						</form>
						<!-- Form for selecting a meeting time -->
						<form id="instructor-times" method="POST" action="/instructorMeeting">
							{{csrf_field()}}

							<input type="hidden" name="currentWeek" value="{{$week[0]}}">
							<input type="hidden" name="instructor" value="{{$instructor->id}}">
							<h3>Select a Time</h3>
							<div class="radio">
								<h4>Times that match your free time.</h4>
								@foreach ($availMatch as $match)
									<label><input type="radio" name="start_time" value="{{$match}}">{{ $match }}</label></br>
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
