@extends('wizard/layout')
@section('wizard-content')
<form id="wizard-form" class="" action="/wizard/title" method="post">
  {{ csrf_field() }}
  <!-- TITLE -->
  <div class="form-group">
    <label for="role">Are you a...</label>
    <select class="form-control" name="title">
      <option value="student">Student</option>
      <option value="ta">Teacher Assistant</option>
      <option value="teacher">Teacher</option>
    </select>
  </div>
<!-- TITLE -->
</form>
@endsection

@section('wizard-pagination')
<button class="wizard-next">Next
  <!-- <a href="{{url('wizard/course')}}">Next</a> -->
</button>
@endsection
