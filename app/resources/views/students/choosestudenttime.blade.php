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
							<input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" name="currentWeek" value="{{$week[0]}}">
                            {{csrf_field()}}
							<div class="radio">
								<h4>Select a Meeting Time</h4>
								@if(!$students->isEmpty())
                                	@foreach ($students as $student)
                                    	<h4>{{$student->name}}</h4>
	                                    @foreach ($matches[$student->id] as $match)
										<!-- serialization allows array to be passed as value. Any better ways of associating selected time with corresponding student->id? -->
	                                    <label><input name="time" value="{{serialize(array($match, $student->id))}}" type="radio">{{ $match }}</label></br>
	                                    @endforeach
	                                @endforeach
								@else
									<p><Label>No student matches</Label></p>
								@endif
							</div>
							<button class="btn btn-default" type="submit" value="selection">Next</button>
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
@endsection
@include('common')
