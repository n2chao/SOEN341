<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home page
Route::get('/', function () {
    //return view('landing');
    return view('landing');
});
//End Home page

Route::get('/rating', function () {
    //return view('landing');
    return view('rating');
});

Auth::routes();

//Facebook routes
Route::get('auth/facebook', 'FacebookController@facebookRedirect')->name('facebook.login');
Route::get('auth/facebook/callback', 'FacebookController@facebookCallback');
//End Facebook routes

//groups all routes requiring authentication
Route::group(['middleware' => ['auth']], function () {

  //Wizard Routes
  Route::get('/wizard','WizardController@index');
  Route::get('/wizard/title','WizardController@create_title');
  Route::post('/wizard/title','WizardController@store_title');

  Route::get('/wizard/course','WizardController@create_course');
  Route::post('/wizard/course','EnrollmentController@store');

  Route::get('/wizard/schedule','WizardController@create_schedule');
  Route::post('/wizard/schedule','WizardController@store_schedule');
  //End Wizard Routes

  //search courses
  Route::get('/search', 'CourseController@search');
  Route::get('/course', 'EnrollmentController@create');     //GET view for enrolling in new courses
  Route::post('/course', 'EnrollmentController@store');     //POST enroll courses
  Route::get('courses/course/{code}', 'EnrollmentController@dropCourse');

  //ADD AUTHENTICATED ROUTES UNDER
  //Groups all routes requiring to go to wizard if setup is not completed
  Route::group(['middleware' => ['wizard']], function () {

    Route::get('/home', 'HomeController@index');

    //Courses
    Route::get('courses/course', 'EnrollmentController@index');
    //end Courses

    //Schedules
    Route::get('/schedule','ScheduleController@index');
    Route::get('/schedule/create','ScheduleController@create');
    Route::post('/schedule/create','ScheduleController@store');
    Route::get('/schedule/edit','ScheduleController@edit');
    Route::post('/schedule/edit','ScheduleController@update');
    //End Schedule

    //instructor meetings
    Route::get('instructors/chooseinstr', 'InstructorController@index');
    Route::get('/choosetime', 'matchTimeController@create');

    //GET all meetings (student or instructor)
    Route::get('meetings','MeetingController@index');
    //POST new meeting (instructor only)
    Route::post('instructorMeeting','MeetingController@store');
    //GET specific meeting (student or instructor)
    Route::get('meetings/{meeting}', 'MeetingController@show');
    //DELETE specific meeting (student or instructor) (named route to send DELETE request)
    Route::delete('meetings/{meeting}', 'MeetingController@destroy')->name('meetings.destroy');
    //GET all enrolled courses for student
    Route::get('requests', 'StudentController@index');
    //GET form for creating student meeting request for given course
    Route::get('requests/create', 'RequestController@create');
    //POST to create new student meeting request
    Route::post('requests/create', 'RequestController@store');
    //DELETE specific meeting request (named route to send DELETE request)
    Route::delete('requests/{request}', 'RequestController@destroy')->name('requests.destroy');
    //GET specific meeting request
    Route::get('requests/{request}', 'RequestController@show');
    //GET to accept a meeting request
    Route::get('requests/{request}/accept', 'RequestController@accept')->name('requests.accept');;
  });

});
