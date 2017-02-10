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
    return view('landing');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//NOTE it is best to achieve www.site.com/patrickspensieri/courses...

//get all available courses
Route::get('/allcourses', 'CourseController@index');




//routes with auth
Route::group(['middleware' => 'auth'], function () {
    //get courses enrolled by the user
    Route::get('/courses', 'EnrollmentController@index');
    
    //get form to create a new enrollment
//    Route::get('/courses/enroll', 'EnrollmentController@create'); //missing course argument!!
    
    //create new enrollment
    Route::post('/courses', 'EnrollmentController@store');
    
});

/*
GET /courses (get all enrolled courses by authenticated user)

GET /courses/create (get the enrollment form )

POST /courses (store a new post)

GET /courses/{id}/edit (edit an exisiting enrollment)

GET /courses/{id} (show a particular enrolled course)

PATCH /courses/{id} (edit an enrollment)

DELETE /courses/{id} (delete an enrollment)
*/