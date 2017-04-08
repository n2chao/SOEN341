@section('content')

<div class="container">
  <div class="row">
   <div class="col-md-3">

      <!-- SIDEBAR -->
     <div>
      
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
  @yield('extra-content')
</div>
</div>
@endsection
