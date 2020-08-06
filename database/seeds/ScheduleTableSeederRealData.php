<?php

use App\Classes\Groups;
use App\Models\Schedule;
use App\Models\Competition;
use App\Classes\TeamsToPots;
use App\Classes\MatchesWeeksSchedule;

class ScheduleTableSeederRealData extends BaseSeeder
{
    protected $table = 'schedules';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->truncateTable($this->table);

        $competition = Competition::find(1);
        $matches_schedule = (new MatchesWeeksSchedule(new Groups(new TeamsToPots($competition))))->matches($competition);

        foreach ($matches_schedule as $week_schedule) {
            foreach ($week_schedule as $match) {
                Schedule::create($match);
            }
        }
    }
}
