<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Schedule;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition)
    {
        return $competition->schedules()->with(['home', 'away']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition, Schedule $schedule)
    {
        return $schedule->with(['home', 'away']);
    }
}
