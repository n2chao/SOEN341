@extends('layouts.app')

@section('extra-content')
<!-- SCHEDULE -->
              <div class="panel panel-default">
                  <div class="panel-heading">Schedule</div>

                  <div class="panel-body">

                    {{-- Message --}}
                    <div class="well">
                      Here are your availabilities
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

                    {{-- table --}}
                    <table class="table table-bordered">
                      {{-- Generate days--}}
                      <tr>
                          @for ($day = 0; $day < 7; $day++)
                            <th>
                              @if     ( $day == 0 ) Sun
                              @elseif ( $day == 1 ) Mon
                              @elseif ( $day == 2 ) Tue
                              @elseif ( $day == 3 ) Wen
                              @elseif ( $day == 4 ) Thu
                              @elseif ( $day == 5 ) Fri
                              @elseif ( $day == 6 ) Sat
                              @endif
                            </th>
                          @endfor
                      </tr>
                      {{-- End Generate days--}}

                      {{-- Hours days--}}
                      @for ($hour = 0; $hour < 24; $hour++)
                      <tr>
                        @for ($day = 0; $day < 7; $day++)
                        <td>
                          <label for="">
                            <input type="checkbox" name="freetime[]" value="{{$day}}{{$hour}}"
                            @if ($schedule->freetime[($day*24)+$hour] == 1 )
                              checked
                            @endif
                            disabled
                            >
                              {{$hour}}
                              @if ($hour < 12)
                                AM
                              @else
                                PM
                              @endif
                          </label>
                        </td>
                        @endfor
                      </tr>
                      @endfor
                      {{-- End Hours days--}}
                    </table>
                    <button type="button" name="button">
                      <a href="/schedule/edit">Edit</a>
                    </button>
                  </div>
              </div>
<!-- END SCHEDULE -->
@endsection
@include('common')
