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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('activities', 'ActivityController');

Route::resource('classes', 'ClassController');

Route::resource('clients', 'ClientController');

Route::resource('machines', 'MachineController');

Route::resource('news', 'NewController');

Route::resource('routines', 'RoutineController');

Route::resource('users', 'UserController');

Route::resource('classTypes', 'ClassTypeController');

Route::resource('classSchedules', 'ClassScheduleController');

Route::resource('keys', 'KeyController');