@section('content')

<div class="container">
  <div class="row">
    <!-- Left column -->
    <div class="col-md-3">

      <!-- DASH SIDEBAR -->
      <div id="dash-sidebar" class="dash">

         <!-- SIDEBAR USER TITLE -->
         <div>
             <h3>{{ Auth::user()->name }}</h3>
         </div>
         <!-- END SIDEBAR USER TITLE -->

         <!-- SIDEBAR MENU -->
         <div>
           <ul class="nav">
             <li class="active default">
               <a href="/home">
               Overview </a>
             </li>
             <li>
               <a href="#">
               Account Settings </a>
             </li>
             <li>
               <a href="/requests">
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
    <!-- End Left column -->

    <!-- Main Right Column -->
    <div class="col-md-9">

    <!-- GLOBAL ANNOUNCEMENT -->
    @component('global-announcement')
    @endcomponent
    <!-- END GLOBAL ANNOUNCEMENT -->


     <!-- Main Right Content -->
     @yield('extra-content')
     <!-- Main Right Content -->
   </div>
   <!-- End Main content -->

  </div>
</div>
@endsection
