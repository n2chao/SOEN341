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



Route::get('/chooseinstr', 'InstructorController@index');
Route::get('/choosetime', 'InstructorController@show');



//instructor meetings
Route::get('instructors/chooseinstr', 'InstructorController@index');
Route::get('instructors/choosetime', 'InstructorController@show');



//GET all available courses
Route::get('/allcourses', 'CourseController@index');


//groups all routes requiring authentication
Route::group(['middleware' => 'auth'], function () {

    Route::get('/setup', 'SetupController@index');
    Route::get('/setup/title', 'SetupController@Title');
    Route::post('/setup/title', 'SetupController@setTitle');
    Route::get('/setup/course', 'SetupController@course');
    Route::post('/setup/course', 'SetupController@setCourse');

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


    Route::get('/wizard','WizardController@index');
    Route::get('/wizard/title','WizardController@create_title');
    Route::post('/wizard/title','WizardController@store_title');


    //groups all routes requiring to go to wizard if setup is not completed
    Route::group(['middleware' => ['wizard']], function () {
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

      Route::get('/chooseinstr', 'InstructorController@index');
      Route::get('/choosetime', 'InstructorController@show');

      //instructor meetings
      Route::get('instructors/chooseinstr', 'InstructorController@index');
      Route::get('instructors/choosetime', 'InstructorController@show');

      //GET all meetings
      Route::get('meetings','MeetingController@index');

      //POST new meeting
      Route::post('instructorMeeting','MeetingController@store');
      //GET specific meeting
      Route::get('meetings/{meeting}', 'MeetingController@show');
      //DELETE specific meeting
      Route::delete('meetings/{meeting}', 'MeetingController@destroy')->name('meetings.destroy');

      Route::get('/choosetime', 'matchTimeController@create');
    });

    //Wizard Routes
    Route::get('/wizard','WizardController@index');
    Route::get('/wizard/title','WizardController@create_title');
    Route::post('/wizard/title','WizardController@store_title');

});
