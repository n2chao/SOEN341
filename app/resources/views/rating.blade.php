  @extends('layouts.app')
  @section('extra-content')

    <div class="col-md-9">
    <div id="course-panel" class="panel panel-default">
      <div class="panel-heading">Rate our web application!</div>
        <div class="panel-body">

        <p><strong>Hey buddy, please rate your experience that you had with our web application!</strong></p>
  	<p> 1) I was able to find a study buddy :</p>
  	<span class="rating">
  			<input type="radio" class="rating-input"
  				id="rating-input-1-5" name="rating-input-1">
  			<label for="rating-input-1-5" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-1-4" name="rating-input-1">
  			<label for="rating-input-1-4" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-1-3" name="rating-input-1">
  			<label for="rating-input-1-3" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-1-2" name="rating-input-1">
  			<label for="rating-input-1-2" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-1-1" name="rating-input-1">
  			<label for="rating-input-1-1" class="rating-star"></label>
  		</span>
  		<br/>
  	<p> 2) I was able to make an appointment with a teacher or a teacher assistant:</p>
  	<span class="rating">
  			<input type="radio" class="rating-input"
  				id="rating-input-2-5" name="rating-input-2">
  			<label for="rating-input-2-5" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-2-4" name="rating-input-2">
  			<label for="rating-input-2-4" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-2-3" name="rating-input-2">
  			<label for="rating-input-2-3" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-2-2" name="rating-input-2">
  			<label for="rating-input-2-2" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-2-1" name="rating-input-2">
  			<label for="rating-input-2-1" class="rating-star"></label>
  		</span>
  	<br>
  	<p> 3) This web application is easy to surf on : </p>
  	<span class="rating">
  			<input type="radio" class="rating-input"
  				id="rating-input-3-5" name="rating-input-3">
  			<label for="rating-input-3-5" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-3-4" name="rating-input-3">
  			<label for="rating-input-3-4" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-3-3" name="rating-input-3">
  			<label for="rating-input-3-3" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-3-2" name="rating-input-3">
  			<label for="rating-input-3-2" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-3-1" name="rating-input-3">
  			<label for="rating-input-3-1" class="rating-star"></label>
  		</span>
  		<br/>
  	<p> 4) Using this web application helped my learning process :</p>
  		<span class="rating">
  			<input type="radio" class="rating-input"
  				id="rating-input-4-5" name="rating-input-4">
  			<label for="rating-input-4-5" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-4-4" name="rating-input-4">
  			<label for="rating-input-4-4" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-4-3" name="rating-input-4">
  			<label for="rating-input-4-3" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-4-2" name="rating-input-4">
  			<label for="rating-input-4-2" class="rating-star"></label>
  			<input type="radio" class="rating-input"
  				id="rating-input-4-1" name="rating-input-4">
  			<label for="rating-input-4-1" class="rating-star"></label>
  		</span>
  		<br/>

  		<form action="">
  		<p>If you ever have any comments,suggestions or complaints, feel free to share them with us down below : </p>
  		<textarea name="message" rows="10" cols="70"></textarea>
  		<br>
      <div class="form-group">
          <button type="submit" class="btn btn-primary ">
          Submit
          </button>
      </div>
  		</form>
    </div>
    </div>
  </div>
  </div>
      @endsection
      @include('common')
