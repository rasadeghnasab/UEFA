<?php
/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
 */
Route::apiResources([
    'competitions' => 'CompetitionsController',
    'competitions.tournaments'  => 'TournamentsController',
    'teams'        => 'TeamsController',
]);
Route::apiResource('competitions.schedules', 'SchedulesController')->only(['index', 'show']);

Route::post('predict/{schedule}', 'HoldingMatchesController@executeAMatch');
Route::post('predict/{competition}/level', 'HoldingMatchesController@executeAllMatchesInALevel');
