@extends('layouts.app')

@section('extra-content')
	<div class="col-md-9">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Find a Study Buddy</div>
					<div class="panel-body">
                        <div class="panel-body">
						<!-- Form for changing the week -->
						<form method="GET" action="/requests/create">
							<div class="row">
								<div class="col-md-3">
									<p id="newWeek">From: <?php echo date("D, M d, Y H:i:s", $week[0])?></p>
								</div>
								<div class="col-md-3">
									<p id="newWeek">To: <?php echo date("D, M d, Y H:i:s", $week[1])?></p>
								</div>
							</div>
                            <input type="hidden" name="course" value="{{$course->id}}">
							<input type="hidden" name="weekStart" value="{{$week[0]}}">
							<input type="hidden" name="weekEnd" value="{{$week[1]}}">

							<div>
								<button type="btn btn-default" name="prevWeek" value="prevWeek">Previous Week</button>
								<button type="btn btn-default" name="nextWeek" value="nextWeek">Next Week</button>
							</div>
						</form>
                        <!-- Form for selecting a meeting time -->
						<form method="POST" action="/requests/create">
                            <input type="hidden" name="currentWeek" value="{{$week[0]}}">
                            {{csrf_field()}}
							<div class="radio">
								<h4>Select a Meeting Time</h4>
                                @foreach ($students as $student)
                                    <h4>{{$student->name}}</h4>
                                    @foreach ($matches[$student->id] as $match)
                                    <label><input name="match" value="{{$match}}" type="radio">{{ $match }}</label></br>
                                    @endforeach
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
