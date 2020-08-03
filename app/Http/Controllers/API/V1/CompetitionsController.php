<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Competition::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Competition::create($request->only(['name', 'year', 'start_date']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
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
        $competition->update($request->only(['name', 'year', 'start_date']));
        $competition->refresh();

        return $competition;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $result = $competition->delete();

        $message = $result ? 'Competition remove successfully.' : 'Failed to remove the competition';
        return response([
            'status' => $result ? 200 : 400,
            'message' => __($message),
        ]);
    }
}
