<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DailyMeeting;

class DailyMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailys = DailyMeeting::whereDate('created_at', today())
            // ->groupBy('user_id')
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('user_id');

        return view('daily-meeting', compact('dailys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DailyMeeting  $dailyMeeting
     * @return \Illuminate\Http\Response
     */
    public function show(DailyMeeting $dailyMeeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DailyMeeting  $dailyMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyMeeting $dailyMeeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DailyMeeting  $dailyMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyMeeting $dailyMeeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DailyMeeting  $dailyMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyMeeting $dailyMeeting)
    {
        //
    }
}
