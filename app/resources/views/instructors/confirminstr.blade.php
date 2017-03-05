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
							<button class="btn btn-default" type="submit" name="instructor-names-next">Done</button>
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
@endsection
@include('common')