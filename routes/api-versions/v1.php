<?php
/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
 */
Route::apiResources([
    'competitions' => 'CompetitionsController',
    'tournaments'  => 'TournamentsController',
    'teams'        => 'TeamsController',
]);
