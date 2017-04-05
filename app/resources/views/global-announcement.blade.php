<div class="global-announcement dash">
  <h2>Announcements</h2>

  {{-- Give warnning if missing enrollments --}}
    @if( count( Auth::user()->enrollments ) == 0 )
      <div class="alert alert-warning">
        Oups? Forgot to <a href="{{url('courses/course')}}">enroll</a> in courses?
      </div>
    @endif
  {{-- End Give warnning if missing enrollments --}}

  {{-- Give warnning if missing schedule --}}
    @if( !isset(Auth::user()->schedule ) )
      <div class="alert alert-warning">
        Oups? Forgot to put your study <a href="{{url('/schedule/create')}}">availablities</a>?
      </div>
    @endif
  {{-- Give warnning if missing schedule --}}

</div>
