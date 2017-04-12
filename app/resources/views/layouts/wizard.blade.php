@extends('layouts.app')

@section('extra-content')
<!-- WIZARD TITLE -->
<div class="panel panel-default">
    <div class="panel-heading">Wizard</div>

    <div class="panel-body">

      {{-- Message --}}
      <div class="well">
        Welcome! Before we start, I need to know a little more about you.
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
      
      {{-- End Content--}}

    </div>
</div>
<!-- END WIZARD TITLE -->

        <script type="text/javascript" src="{{ asset('js/jquery-3.2.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/wizard.js') }}"></script>
@endsection
@include('common')
