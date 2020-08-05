<?php

namespace App\Observers;

use App\Models\Schedule;

class ScheduleObserver
{
    /**
     * Handle the schedule "updated" event.
     *
     * @param  \App\Schedule  $schedule
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        $schedule->redrawTable();
    }
}
