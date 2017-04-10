@extends('layouts.app')
@section('extra-content')
{{-- Enrolled courses --}}
@component('courses.enrolled')
@endComponent
{{-- End Enrolled courses --}}

{{-- Enrolled courses --}}
@component('courses.add')
  @slot('form-path')
         /course
   @endslot
@endComponent
{{-- End Enrolled courses --}}

<script type="text/javascript" src="/js/course.js"></script>
@endsection
@include('common')
