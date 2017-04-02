@extends('layouts.app')

@section('extra-content')
<script type="text/javascript" src="/js/dashboard.js"></script>
<div class="col-md-9">
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
                  @if(!$meetings->isEmpty())
                    <div class="panel-group" style='margin: 15px;'>
                    @foreach ($meetings as $meeting)
                        <div class="panel panel-default">
                          <div class="panel-body" style="background-color:rgba(5,200,45,0.1);">    
                            <div class="row">
                              <div class="col-sm-6">

                                    <h5>Meeting With:
                                    @foreach ($meeting->users->except(Auth::id()) as $attendee)
                                        <span class="label label-default">{{$attendee->name}}</span>
                                    @endforeach
                                    </h5>

                                    <h5>Meeting Time:
                                    <span class="label label-default">{{date("l, F j, Y g:i a", strtotime($meeting->start_time))}}</span>
                                    </h5>

                              </div>
                              <div class="col-sm-3"></div>
                              <div class="col-sm-3">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['meetings.destroy', $meeting->id]]) }}
                                    {{ Form::submit('Leave meeting', ['class' => 'btn btn-danger', 'style'=>'margin-top: 20px;']) }}
                                    {{ Form::close() }}
                              </div> 
                            </div>
                          </div>
                        </div>
                        @endforeach
                    </div>
                  @else
                    <div class="panel-group" style='margin: 15px;'>
                      <div class="panel panel-default">
                        <div class="panel-heading">No scheduled meetings</div>
                      </div>
                    </div>
                  @endif
                  </div>
              </div>

          <!--OPEN MEETING REQUEST PANNEL-->
              <div class="panel panel-default">
              <!--open request Heading-->
                  <div class="panel-heading">Open Meeting Requests</div>
                    <!--open request Body-->
                        <div class="panel-body">
                            @if(!$requests->isEmpty())
                            <!--INNER PANNELS: INDIVIDUAL REQUESTS-->
                            <div class="panel-group" style='margin: 15px;'>
                                @foreach ($requests as $request)
                                <div class="panel panel-default">

                                <!--INNER PANNEL BODY -->    
                                    <div class="panel-body" style="background-color: hsla(0, 100%, 30%, 0.1);">    
                                        <div class="row">
                                            <div class="col-sm-6">
                                                
                                                <h5>Meeting With:
                                                @foreach ($request->users->except(Auth::id()) as $attendee)
                                                <span class="label label-default">{{$attendee->name}}</span>
                                                @endforeach
                                                </h5>

                                                <h5>Meeting Time:
                                                <span class="label label-default">{{date("l, F j, Y g:i a", strtotime($request->start_time))}}</span>
                                                </h5>

                                            </div>
                                            <div class="col-sm-3">
                                                @if($request->receiver()->is(Auth::user()))
                                                    {{ Form::open(['method' => 'GET', 'route' => ['requests.accept', $request->id]]) }}
                                                    {{ Form::submit('Okay to Meet!', ['class' => 'btn btn-default', 'style'=>'margin-top: 20px;']) }}
                                                    {{ Form::close() }}
                                                @endif
                                              
                                            </div>
                                            <div class="col-sm-3">
                                              {{ Form::open(['method' => 'DELETE', 'route' => ['requests.destroy', $request->id]]) }}
                                              {{ Form::submit('Remove Request', ['class' => 'btn btn-danger', 'style'=>'margin-top: 20px;']) }}
                                              {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                @endforeach
                                </div> 
                            @else
                                <div class="panel-group" style='margin: 15px;'>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">No Meeting Requests</div>
                                    </div>
                                </div>
                            @endif
                  </div>
              </div>
        </div>
@endsection
@include('common')
