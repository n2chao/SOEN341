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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/schedule','ScheduleController@index');
    Route::get('/schedule/create','ScheduleController@create');
    Route::post('/schedule/create','ScheduleController@store');
    Route::get('/schedule/edit','ScheduleController@edit');
    Route::post('/schedule/edit','ScheduleController@update');
});
