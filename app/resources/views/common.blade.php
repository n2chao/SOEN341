@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-3">

    <!-- DASH SIDEBAR -->
    <div id="dash-sidebar" class="dash">

     <!-- SIDEBAR USERPIC -->
     <div>
       <!-- Placeholder incase we wish to implement pictures, I can remove this if requested-->
       <img src="https://placehold.it/100x100" class="img-responsive" alt="">
     </div>
     <!-- END SIDEBAR USERPIC -->

     <!-- SIDEBAR USER TITLE -->
     <div>
         <h3>{{ Auth::user()->name }}</h3>
     </div>
     <!-- END SIDEBAR USER TITLE -->

     <!-- SIDEBAR MENU -->
     <div>
       <ul class="nav">
         <li class="active default">
           <a href="#">
           Overview </a>
         </li>
         <li>
           <a href="#">
           Account Settings </a>
         </li>
         <li>
           <a href="#" target="_blank">
           Find a Buddy </a>
         </li>
         <li>
           <a href="/instructors/chooseinstr">
            Find an Instructor</a>
         </li>
         <li>
           <a href="/schedule">
            Edit Availabilities</a>
         </li>
         <li>
           <a href="/courses/course">
            Edit Courses</a>
         </li>
       </ul>
     </div>
     <!-- END MENU -->
    </div>
   </div>
     <!-- END DASH SIDEBAR -->
     <div class="col-md-9">

       <!-- GLOBAL ANNOUNCEMENT -->
      @component('global-announcement')
      @endcomponent
      <!-- END GLOBAL ANNOUNCEMENT -->

      @yield('extra-content')
    </div>
    <!-- END DASH SIDEBAR -->
  </div>
</div>
@endsection
