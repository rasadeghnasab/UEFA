<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\GamePrediction\PredictResult;
use Exception;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
