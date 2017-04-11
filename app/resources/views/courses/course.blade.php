@extends('layouts.app')
@section('extra-content')

  {{-- Enrolled courses --}}
  @component('courses.enrolled')
  @endComponent
  {{-- End Enrolled courses --}}

  {{-- Enrolled courses --}}
  @component('courses.add')
  @endComponent
  {{-- End Enrolled courses --}}

@endsection
@include('common')
