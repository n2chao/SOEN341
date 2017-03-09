@extends('layouts.app')

@section('extra-content')
	<div class="col-md-9">
        <div class="profile-content">
          	<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Which Course do would you like to study with your BUDDY?</div>
					<div class="panel-body">
						<h3>Select your course</h3>
							<form>
								<div type="radio">
									@foreach($courses as $course)
										<label><input type="radio">{{$course}}</label><br>
									@endforeach
									<button class="btn bt-default" type="submit" name="Submit">Submit</button>
								</div>
						</form>


					</div>

				</div>
			</div>
		</div>
	</div>
@endsection
@include('common')
