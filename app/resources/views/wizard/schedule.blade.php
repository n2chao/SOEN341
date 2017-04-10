@extends('wizard/layout')
@section('wizard-content')
{{-- Form: Wizard Create schedule --}}
<form id="wizard-form" class="" action="/wizard/schedule" method="post">
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
</form>
{{-- End Form: Wizard Create schedule --}}
@endsection

@section('wizard-pagination')
<button><a href="{{url('wizard/course')}}">Back</a></button>
<button class="wizard-next">Finish</button>
@endsection
