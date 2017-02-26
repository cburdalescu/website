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
Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('calendar', 'CalendarController');


    Route::get('api', function () {
        $events = DB::table('calendars')->select('id', 'name', 'title', 'start_time as start', 'end_time as end')->get();
        foreach($events as $event)
        {
            $event->title = $event->title . ' - ' .$event->name;
            $event->url = url('calendar/' . $event->id);
        }
        return $events;
    });
});

