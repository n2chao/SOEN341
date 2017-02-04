@extends('layouts.app')

@section('content')

	<div id="bg-fade-carousel" class="carousel slide carousel-fade" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<h1 class="slide1">Find a study buddy now !</h1></br>
				<p class="item-p">Pick the class and find someone who is free !</p>
			</div>
			<div class="item">
				<h1 class="slide2">No more back and forth !</h1></br>
				<p class="item-p">Organize a meeting and set it in your schedule !</p>
			</div>
			<div class="item">
				<h1 class="slide3">Just click and meet !</h1></br>
				<p class="item-p">A list of available buddies for each course at you fingertips !<br>Also schedule a meeting with your Professor or TA !</p>
				
			</div>
		</div>
	</div>

<script>$('.carousel').carousel()</script>


@endsection