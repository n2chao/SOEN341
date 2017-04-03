@extends('layouts.app')

@section('extra-content')
<script type="text/javascript" src="/js/dashboard.js"></script>
<!-- HOME CONTENT -->
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
                      @foreach ($meetings as $meeting)
<!--                  <form method="" action="/meetings/{{$meeting->id}}">-->
                      <!-- HTMl can't make DELETE request, so 'method spoofing' is used-->
                      <!-- Display calendar of week with 7 days and timeslots-->
                      <p>id = {{$meeting->id}}</p>
                      <p>start_time = {{$meeting->start_time}}</p>
                      <p>end_time = {{$meeting->end_time}}</p>
                      <p><Label>Attendee(s)</Label></p>
                      <!--TEST : Calling eloquent relationships from the view is bad practice -->
                        @foreach ($meeting->users->except(Auth::id()) as $attendee)
                        <p>{{$attendee->name}}</p>
                        @endforeach
                    {{ Form::open(['method' => 'DELETE', 'route' => ['meetings.destroy', $meeting->id]]) }}
                    {{ Form::submit('Leave meeting', ['class' => 'btn btn-danger']) }}
                    {{ Form::close() }}
<!--                        <button type="submit" class="btn-primary">Leave Meeting</button>-->
                      <p>--------------------------------------</p>
<!--                      </form>-->
                      @endforeach
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">Buddy Matches</div>

                  <div class="panel-body">
                      <!-- Display matches of people with the same availablility & class-->
                      <div class="panel panel-primary">
                        <div class="panel-heading">New matches for COURSE_NAME1</div>
                        <div class="panel-body">
                          <div id="ifMatchesEmpty"></div>
                          <table id="matches" class="table">
                            <tbody>
                            <tr>
                              <td>You matched with USER_NAME1<br>for availabilities from MUTUAL_START1 to MUTUAL_END1 &nbsp;<td>
                              <td>
                                <input type="button" value="Confirm" class="btn btn-success">
                                <input type="button" value="Decline" class="btn btn-danger" onclick="deleteRow(this, 'matches')">
                              </td>
                            </tr>
                            <tr>
                              <td>You matched with USER_NAME2<br>for availabilities from MUTUAL_START2 to MUTUAL_END2 &nbsp;<td>
                              <td>
                                <input type="button" value="Confirm" class="btn btn-success">
                                <input type="button" value="Decline" class="btn btn-danger" onclick="deleteRow(this, 'matches')">
                              </td>
                            </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
              </div>
<!-- END HOME CONTENT -->
@endsection
@include('common')
