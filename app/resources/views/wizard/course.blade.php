@extends('wizard/layout')
@section('wizard-content')

  @component('courses.enrolled')
  @endcomponent
  @component('courses.add')
  @endcomponent

<script type="text/javascript" src="/js/course.js"></script>
@endsection

@section('wizard-pagination')
<button><a href="{{url('wizard/title')}}">Back</a></button>
<button class="wizard-next"><a href="{{url('wizard/schedule')}}">Next</a></button>
@endsection
