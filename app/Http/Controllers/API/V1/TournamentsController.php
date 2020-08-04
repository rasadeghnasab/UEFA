<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use App\Classes\Groups;
use App\Models\Competition;
use App\Classes\TeamsToPots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Classes\MatchesWeeksSchedule;
use App\Http\Requests\CreateTournamentRequest;
use App\Models\Schedule;

class TournamentsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition)
    {
        return $competition->tournament();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTournamentRequest $request, Competition $competition)
    {
        $message = 'Tournament created succseefully.';
        $result = true;
        try {
            $schedules = DB::transaction(function () use ($request, $competition) {
                foreach ($request->get('tournament') as $team) {
                    $competition->teams()->attach($team['team'], [
                        'pot' => $team['pot'],
                    ]);
                }

                $matches_schedule = (new MatchesWeeksSchedule(new Groups(new TeamsToPots($competition))))->matches($competition);

                $schedules = [];
                foreach ($matches_schedule as $week_schedule) {
                    foreach ($week_schedule as $match) {
                        $schedules[] = (Schedule::create($match))->load(['home', 'away']);
                    }
                }

                return $schedules;
            });
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $schedules = [];
        }

        return response([
            'message' => $message,
            'status' => $result ? 200 : 400,
            'data' => [
                'competition' => $competition,
                'schedules' => $schedules
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        // Todo: This update method should be implement.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $result = $competition->tournament()->delete();

        $message = $result ? 'Tournament remove successfully.' : 'Failed to remove the tournament';
        return response([
            'status' => $result ? 200 : 400,
            'message' => __($message),
        ]);
    }
}
