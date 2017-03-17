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

Route::get('/', function () {
    //return view('landing');
    return view('landing');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

//GET all available courses
Route::get('/allcourses', 'CourseController@index');


//groups all routes requiring authentication
Route::group(['middleware' => 'auth'], function () {

    //GET view for enrolling in new courses
    Route::get('/courses', 'EnrollmentController@create');

    //POST enroll courses
    Route::post('/courses', 'EnrollmentController@store');
});


//Facebook routes
Route::get('auth/facebook', 'FacebookController@facebookRedirect')->name('facebook.login');
Route::get('auth/facebook/callback', 'FacebookController@facebookCallback');


Auth::routes();

//groups all routes requiring authentication
Route::group(['middleware' => ['auth']], function () {
  //GET all available courses
  Route::get('allcourses', 'CourseController@index');

  //Courses
  Route::get('courses/course', 'EnrollmentController@index');
  Route::get('courses/course/{code}', 'EnrollmentController@dropCourse');
  Route::get('/course', 'EnrollmentController@create');     //GET view for enrolling in new courses
  Route::post('/course', 'EnrollmentController@store');     //POST enroll courses
  //end Courses

  //Schedules
  Route::get('/schedule','ScheduleController@index');
  Route::get('/schedule/create','ScheduleController@create');
  Route::post('/schedule/create','ScheduleController@store');
  Route::get('/schedule/edit','ScheduleController@edit');
  Route::post('/schedule/edit','ScheduleController@update');
  //End Schedule

  Route::get('/home', 'HomeController@index');


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


Route::get('/course', function(){
    return view('course');
 });

