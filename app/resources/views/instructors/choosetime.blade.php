@extends('layouts.app')

@section('extra-content')
<!-- INSTRUCTOR TIME -->
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Choose a Meeting Time</div>
					<div class="panel-body">

						<!-- Form for changing the week -->
						<form id="changeWeek" method="GET" action="/choosetime">
							{{csrf_field()}}
							<input type="hidden" name="instructor" value="{{$instructor->id}}">
							<input type="hidden" name="weekStart" value="{{$week[0]}}">
							<input type="hidden" name="weekEnd" value="{{$week[1]}}">
							
							<div class='row'>
								<div class='col-md-8'>
									<div class='container' style='margin: 5px;'>
										{{$instructor->name}}
									</div>
								</div>
								<div class='col-md-4'>
									<div class='container' style='margin: 5px;'>
										<button type="btn btn-default" name="prevWeek" value="prevWeek">Previous Week</button>
										<button type="btn btn-default" name="nextWeek" value="nextWeek">Next Week</button>
									</div>
								</div>
							</div>	
							

						</form>
							
							<div class="row">
								<div class="col-md-12">
									<form id="instructor-times" method="POST" action="/instructorMeeting">
										{{csrf_field()}}
										<input type="hidden" name="currentWeek" value="{{$week[0]}}">
										<input type="hidden" name="instructor" value="{{$instructor->id}}">
										<?php 
											date_default_timezone_set("America/New_York");
											echo "<table class='table .table-bordered'><thread><tr>";
													
												$i = $week[0];
												if(date("l", $i) != "Sunday"){
													while(date("l", $i) != "Sunday"){
														$i = strtotime("-1 day", $i);
													}
												}
												
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";

												$i = strtotime("+1 day", $i);
												$display = date("D, M j", $i);
												echo "<th> $display </th>";
										
											echo "</tr></thread> <tbody> <tr> <td>";
												
												$day = "/^Sunday/s";

												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 6);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";

												$day = "/^Monday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 6);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Tuesday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 7);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Wednesday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 9);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Thursday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 8);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Friday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 6);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";

											echo "</td><td>";
											$day = "/^Saturday/s";
												echo "<div class='col-sm-12'><div class='radio'>";
												foreach ($finalMatch as $match){
													if(preg_match($day, $match)){
														$time = substr($match, 8);
														echo "<input type='radio' name='start_time' value='$match'>$time</br>";
													}
												}
												echo "</div></div>";
											
											echo "</td></tr> </tbody></table>";
										?>
										<button class="btn btn-default" type="submit" name="instructor-names-next">Add to Schedule</button>
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
<!-- END INSTRUCTOR TIME -->
@endsection
@include('common')
