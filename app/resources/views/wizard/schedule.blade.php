@extends('layouts.app')

@section('extra-content')
<!-- SCHEDULE CONTENT -->
<div class="panel panel-default">
    <div class="panel-heading">Wizard</div>

    <div class="panel-body">

      {{-- Message --}}
      <div class="well">
        What are you free to meet?
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
      <form class="" action="/wizard/schedule" method="post">
        {{ csrf_field() }}
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
                <input type="checkbox" name="freetime[]" value="{{$day}}{{$hour}}">
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
        <button type="submit" name="button" value="submit">Done</button>
      </form>
      {{-- End Content--}}

    </div>
</div>
<!-- END SCHEDULE -->

      <script type="text/javascript" src="{{ asset('js/jquery-3.2.0.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/jquery.steps.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/wizard.js') }}"></script>

@endsection
@include('common')
