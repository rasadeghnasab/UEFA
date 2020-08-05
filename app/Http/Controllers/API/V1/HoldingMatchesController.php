<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use App\Models\Schedule;
use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\GamePrediction\PredictResult;

class HoldingMatchesController extends Controller
{
    public function executeAMatch(Schedule $schedule)
    {
        $match_result = (new PredictResult($schedule))->matchResult();
        $message = 'Schedule updated successfully.';

        try {
            $updated = $schedule->update($match_result);
            $schedule->refresh();
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $updated = false;
        }

        return response([
            'data' => [
                'stauts' => $updated ? 200 : 400,
                'schedule' => $schedule,
                'match_result' => $match_result,
                'message' => $message,
            ]
        ]);
    }

    public function executeAllMatchesInALevel(Request $request, Competition $competition, string $level)
    {
        $schedules = Schedule::where('competition_id', $competition->id)->where('level', $request->get('level', 'group'))->get();

        $message = 'All schedules updated successfully.';
        foreach ($schedules as $schedule) {
            $match_result = (new PredictResult($schedule))->matchResult();

            try {
                $updated = $schedule->update($match_result);
                $schedule->refresh();
            } catch (Exception $exception) {
                $message = $exception->getMessage();
                $updated = false;
            }
        }

        return response([
            'data' => [
                'stauts' => $updated ? 200 : 400,
                'message' => $message,
            ]
        ]);
    }
}
