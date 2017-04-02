@extends('layouts.app')

@section('extra-content')
<div class="col-md-9">
              <div class="panel panel-default">
                  <div class="panel-heading">Wizard</div>

                  <div class="panel-body">

                    {{-- Message --}}
                    <div class="well">
                      Welcome! Before we start, I need to know a little more about you.
                    </div>

                    {{-- error --}}
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    {{-- Content --}}
                    <form class="" action="/wizard/title" method="post">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="role">Are you a...</label>
                        <select class="form-control" name="title">
                          <option value="student">Student</option>
                          <option value="ta">Teacher Assistant</option>
                          <option value="teacher">Teacher</option>
                        </select>
                      </div>
                      <button type="submit" name="button" value="submit">Done</button>
                    </form>
                    {{-- End Content--}}

                  </div>
              </div>
        </div>
        <script type="text/javascript" src="{{ asset('js/jquery-3.2.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/wizard.js') }}"></script>
@endsection
@include('common')
