@extends('layouts.app')
@section('extra-content')
<div class="col-md-9">
        <div class="profile-content">
          <div class="col-md-12">
              <div class="panel panel-default">
                  <div class="panel-heading">Dashboard</div>

                  <div class="panel-body">
                      You are logged in!
                      <a href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">Scheduled Meetings</div>

                  <div class="panel-body">
                      <!-- Display calendar of week with 7 days and timeslots-->
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">Buddy Matches</div>

                  <div class="panel-body">
                      <!-- Display matches of people with the same availablility & class-->
                  </div>
              </div>

          </div>
      </div>
        </div>
@endsection
@include('common')
