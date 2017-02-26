<?php

namespace App\Http\Controllers;

use App\Calendar;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Calendar::all();
        return view('calendar.list')->with(compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'	=> 'required|min:5|max:50',
            'title' => 'required|min:5|max:150',
            'start'	=> 'required',
            'end'   => 'required|date|after:start'
        ]);
        $event 					= new Calendar;
        $event->name			= $request->name;
        $event->title 			= $request->title;
        $event->start_time 		= $request->input('start');
        $event->end_time 		= $request->input('end');
        $event->user_id         = Auth::user()->id;
        $event->save();
        $request->session()->flash('success', 'The event was successfully saved!');
        return redirect('calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Calendar::findOrFail($id);
        $first_date = new DateTime($event->start_time);
        $second_date = new DateTime($event->end_time);
        $difference = $first_date->diff($second_date);
        $data = [
            'page_title' 	=> $event->title,
            'event'			=> $event,
            'duration'		=> $this->format_interval($difference)
        ];
        return view('calendar.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Calendar::findOrFail($id);

        $data = [
            'page_title' 	=> 'Edit '.$event->title,
            'event'			=> $event,
        ];

        return view('calendar.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'	=> 'required|min:5|max:50',
            'title' => 'required|min:5|max:150',
            'start'	=> 'required',
            'end'   => 'required|date|after:start'
        ]);
        $event 					= Calendar::findOrFail($id);
        $event->name			= $request->name;
        $event->title 			= $request->title;
        $event->start_time 		= $request->input('start');
        $event->end_time 		= $request->input('end');
        $event->user_id         = Auth::user()->id;
        $event->save();
        $request->session()->flash('success', 'The event was successfully saved!');
        return redirect('calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Calendar::find($id);
        $event->delete();
        return redirect('calendar');
    }

    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('Y/m/d H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }
    public function change_date_format_fullcalendar($date)
    {
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $time->format('d/m/Y H:i:s');
    }
    public function format_interval(\DateInterval $interval)
    {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y year(s) "); }
        if ($interval->m) { $result .= $interval->format("%m month(s) "); }
        if ($interval->d) { $result .= $interval->format("%d day(s) "); }
        if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
        if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
        if ($interval->s) { $result .= $interval->format("%s second(s) "); }
        return $result;
    }
}
