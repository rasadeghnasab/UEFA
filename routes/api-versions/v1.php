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

Route::get('match/{schedule}/result', 'HoldingMatchesController@executeAMatch');
