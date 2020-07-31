<?php
/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'dashboard'], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::patch('/', 'ProfilesController@update');
        Route::get('statistics', 'ProfilesController@dashboard');
        Route::get('info', 'ProfilesController@info');
        Route::get('addresses', 'ProfilesController@addresses');
        Route::get('purchases', 'ProfilesController@purchases');
        Route::patch('make/me/seller', 'ProfilesController@setRoleToSeller');
    });
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('signup', 'MobilesVerificationController@sendVerificationCode');
    Route::post('verify', 'MobilesVerificationController@validateMobile');
});

Route::group(['prefix' => 'admin'], function () {
    Route::apiResource('provinces', 'ProvincesController');
    Route::apiResource('provinces.cities', 'CitiesController')->only('index', 'store');

    Route::match(['GET', 'HEAD'], 'provinces/province/cities/{city}', 'CitiesController@show');
    Route::match(['PATCH', 'PUT'], 'provinces/province/cities/{city}', 'CitiesController@update');
    Route::delete('provinces/province/cities/{city}', 'CitiesController@destroy');
});

Route::group(['prefix' => 'media'], function () {
    Route::get('images/{model}/{name}/{width?}/{height?}', 'MediasController@image');
});

//Route::group(['prefix' => 'rates'], function () {
//    Route::post('{model}/{id}', 'RatingsController@store'); // rate a model
//    Route::get('{model}/{id}', 'RatingsController@show'); // get a model rating
//    Route::get('{model}/{id}/users/rate', 'RatingsController@history'); // get a user rating on a shop
//});

//Route::group(['prefix' => '{dynamicModel}/{addressable}/addresses'], function () {
//    Route::get('/', 'AddressesControllers@index');
//    Route::post('/', 'AddressesControllers@store');
//    Route::match(['patch', 'put'], '{address}', 'AddressesControllers@update');
//    Route::get('{address}', 'AddressesControllers@show');
//    Route::delete('{address}', 'AddressesControllers@destroy');
//});

Route::group(['prefix' => 'password/reset', 'namespace' => 'Auth'], function () {
    Route::post('request', 'PasswordResetController@create');
    Route::post('verify', 'PasswordResetController@verify');
    Route::post('/', 'PasswordResetController@reset');
});

// Socials integration
//Route::group(['prefix' => 'socials/integration'], function () {
//    Route::post('/instagram', 'InstagramController@getInstagramProviderUrl');
//    Route::delete('/instagram', 'InstagramController@revoke');
//    Route::get('/instagram/callback', 'InstagramController@handleProviderInstagramCallback');
//});

Route::get('filter/through/entities', 'EntitiesFilterController@index');

Route::group(['prefix' => 'events', 'namespace' => 'Events'], function () {
    Route::get('', 'EventsManagementController@index');
    Route::post('', 'EventsManagementController@store');
    Route::match(['PATH', 'PUT'], '{event}', 'EventsManagementController@update');
    Route::delete('{event}', 'EventsManagementController@destroy');

    Route::group(['prefix' => '{event}/registeres'], function () {
        Route::get('', 'EventsRegisterController@index');
        Route::match(['PATH', 'PUT'], '{registered}', 'EventsRegisterController@update');
    });
    Route::post('{event}/athletes/{athlete}', 'EventsRegisterController@store');

    Route::group(['prefix' => '{event}/age-weight-tables/'], function () {
        Route::get('', 'EventsAgeWeightTablesController@index');
        Route::post('', 'EventsAgeWeightTablesController@store');
        Route::match(['PUT', 'PATH'], '', 'EventsAgeWeightTablesController@store');
        Route::delete('', 'EventsAgeWeightTablesController@destroy');
    });
});

Route::group(['prefix' => 'me'], function () {
    Route::group(['prefix' => 'athletes'], function () {
        Route::post('', 'AthletesController@store');                                       # Add a athlete
        Route::match(['PATCH', 'PUT'], '{athlete}', 'AthletesController@update');          # Update athlete (we can only update belt_id as of now)
        Route::delete('{athlete}', 'AthletesController@destroy');
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'ProfilesController@show');
        Route::match(['PATH', 'PUT'], '', 'ProfilesController@update');
    });
});

Route::group(['prefix' => 'masters/{master}'], function () {
    Route::get('/students', 'StudentsController@index');
    Route::put('/students/{student}/confirm', 'StudentsController@confirm_student');
    Route::put('/students/{student}/update', 'StudentsController@update_student');
});


// Route::group(['prefix' => 'admin'], function () {
//     Route::post('sports/create', 'AdminController@storeSport');
//     Route::post('sports/founder/add', 'AdminController@storeFounder');
// });
Route::apiResource('sports', 'SportsController');

Route::get('test', 'TestController@main');
Route::post('test/add/sport/founder', 'TestController@addSportFounder');
