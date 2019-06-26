<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('activities', 'ActivityAPIController');


Route::resource('machines', 'MachineAPIController');

Route::resource('news', 'NewAPIController');

Route::resource('routines', 'RoutineAPIController');

Route::resource('class_reservations', 'ClassReservationAPIController');

Route::resource('class_schedules', 'ClassScheduleAPIController');

Route::resource('client_activities', 'ClientActivityAPIController');

Route::resource('routine_activities', 'RoutineActivityAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('class_types', 'ClassTypeAPIController');

Route::resource('class_schedules', 'ClassScheduleAPIController');

Route::get('calendar', 'CalendarAPIController@index');

Route::get('calendar/next', 'CalendarAPIController@next');

Route::get('calendar/week', 'CalendarAPIController@week');

Route::get('classes', 'ClassAPIController@index');

Route::get('classes/{id}/days', 'ClassAPIController@days');

Route::get('classes/{id}/days/{recurrenceId}/schedules', 'ClassAPIController@schedules');

Route::post('login', 'LoginAPIController@login');

Route::get('routine_clients', 'RoutineClientAPIController@index');

Route::get('clients/{clientId}/routines', 'RoutineClientAPIController@index');

Route::post('clients/{clientId}/routines', 'RoutineClientAPIController@store');

Route::get('clients/{clientId}/routines/next', 'RoutineClientAPIController@next');

Route::get('clients/{clientId}/statistics', 'ClientAPIController@show');

Route::post('clients', 'ClientAPIController@store');