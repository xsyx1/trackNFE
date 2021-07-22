<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'SessionController@store');
        Route::post('resetpassword', 'ResetPasswordController@store');
        Route::post('people', 'PeopleController@store');

        Route::middleware('auth:api')->group(function () {
            Route::delete('logout', 'SessionController@destroy');
            Route::get('profile', 'ProfileController@show');
            Route::put('profile', 'ProfileController@update');
        });

    });

    Route::group(['prefix' => 'cities'], function () {
        Route::get('/search', 'CityController@search');
        Route::get('', 'CityController@index');
        Route::get('{id}', 'CityController@show');
    });

    Route::apiResource('states', 'StateController')->only(['index', 'show']);
    Route::apiResource('cities', 'CityController')->only(['index', 'show']);


    Route::get('get-person-by-nif', 'GetPersonByNifController');

    Route::middleware('auth:api')->group(function () {
        //
    });

   


});
