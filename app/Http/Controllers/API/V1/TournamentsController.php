<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        dd($competition->tournament);
        return $competition->tournament();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition)
    {
        foreach ($request->get('data') as $tournament) {
            $competition->teams()->attach($tournament['team'], [
                'pot' => $tournament['pot'],
            ]);
        }

        return $competition;
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
        //
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
