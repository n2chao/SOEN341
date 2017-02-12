@section('content')

<div class="container">
  <div class="row profile">
   <div class="col-md-3">
     <div class="profile-sidebar">
       <!-- SIDEBAR USERPIC -->
       <div class="profile-userpic">
         <img src="https://placehold.it/100x100" class="img-responsive" alt="">
       </div>
       <!-- END SIDEBAR USERPIC -->
       <!-- SIDEBAR USER TITLE -->
       <div class="profile-usertitle">
         <div class="profile-usertitle-name">
           <h3>{{ Auth::user()->name }}</h3>
         </div>
       </div>
       <!-- END SIDEBAR USER TITLE -->
       <!-- SIDEBAR MENU -->
       <div class="profile-usermenu">
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
             <a href="#">
              Find a TA</a>
           </li>
           <li>
             <a href="#">
              Edit Availabilities</a>
           </li>
           <li>
             <a href="#">
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
