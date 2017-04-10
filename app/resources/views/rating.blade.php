@extends('layouts.app')
@section('extra-content')
<script type="text/javascript" language="javascript">

	<!--
	function start(i) {
	  document.getElementById('starbox'+i).innerHTML="<div onmouseout='start("+i+");'><span id='s1"+i+"' onclick='starSelection(this.id);'onmouseout='outStar(this.id);'onmouseover='overStar(this.id);'>★</span><span id='s2"+i+"' onclick='starSelection(this.id);'onmouseout='outStar(this.id);'onmouseover='overStar(this.id);'>☆</span><span id='s3"+i+"' onclick='starSelection(this.id);'onmouseout='outStar(this.id);'onmouseover='overStar(this.id);'>☆</span><span id='s4"+i+"' onclick='starSelection(this.id);'onmouseout='outStar(this.id);'onmouseover='overStar(this.id);'>☆</span><span id='s5"+i+"' onclick='starSelection(this.id);'onmouseout='outStar(this.id);'onmouseover='overStar(this.id);'>☆</span></div>";
	}

	function overStar(starID){
	  var starNo = starID.charAt(1);
	  var starSe = starID.charAt(2);
	  for(var i=1; i<=5; i++){
		document.getElementById('s'+i+''+starSe).style.color="#ffcc00";
		if(i<=starNo) document.getElementById('s'+i+''+starSe).innerHTML="★";
		if(i>starNo) document.getElementById('s'+i+''+starSe).innerHTML="☆";
	  }
	}

	function outStar(starID){
	  var starNo = starID.charAt(1);
	  var starSe = starID.charAt(2);
	  var rating = document.MyReview.rating.value;
	  for(var i=1; i<=5; i++){
		col = "color"+i;
		if(i<=rating){
		  document.getElementById('s'+i+''+starSe).innerHTML="★";
		  document.getElementById('s'+i+''+starSe).style.color=eval(col);
		}
		if(i>rating) document.getElementById('s'+i+''+starSe).innerHTML="☆";
	  }
	}

	function starSelection(starID){
	  var starNo = starID.charAt(1);
	  var starSe = starID.charAt(2);
	  var uitvoer = "";
	  for (var i=0; i<starNo; i++) {
		uitvoer=uitvoer+"<span>★</span>";
	  }
	  for (var i=starNo; i<5; i++) {
		uitvoer=uitvoer+"<span>☆</span>";
	  }	
	  document.getElementById('starbox'+starSe).innerHTML=uitvoer;
	  
	  document.getElementById('php').innerHTML="<" + "?" + " include('vote.php?no=" + starNo + "&se=" + starSe + "'); " + "?" + ">";

	}

	$('.reset-rating').on('click', function() {
	  starSelection();
	});

	-->
</script>
	<body onload="start(1); start(2); start(3);">
		<div class="col-md-9">
		<div id="rating-panel" class="panel panel-default">
		  <div class="panel-heading">Rate our web application</div>
			<div class="panel-body">	
			
			<div class="container">
			<p><strong>Hey buddy, please share your overall experience, because we would like to hear from you!</strong></p>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-8">
			
			<div class="left"><br/><button class="reset-rating" onClick="start(1);start(2);start(3);">Reset Stars</button></div>
			<br/>
			 <div class="left" align onmouseover="this.style.cursor='default';" style="color: #ffcc00; font-size: 25pt;" id="starbox1"; >
			</div>
			<br/>
			
			<textarea name="TextReview" cols="90" rows="5" placeholder="Write your review here!">
			</textarea>
			<br />
		<div class="form-group">
			  <button type="submit" class="btn btn-primary ">
			  Leave Review
			  </button>
		</div>
		  
			<div id="php"></div>
				</div>
			</div>
			
		</div>
		</div>
		</div>
	<br/>
		
		<div id="reviews-panel" class="panel panel-default">
		  <div class="panel-heading">Reviews</div>
			<div class="panel-body">
			<div class="container">

			<div id="php"></div>
				</div>
			</div>
		</div>
		</div>
</body> 
@endsection
@include('common')
