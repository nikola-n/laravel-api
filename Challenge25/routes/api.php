<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:api')->get('vehicles','VehiclesController@index');
Route::middleware('auth:api')->get('vehicles/{id}','VehiclesController@get');

Route::middleware('auth:api')->post('vehicles/store','VehiclesController@store')->name('store');
Route::middleware('auth:api')->post('vehicles/{id}/update','VehiclesController@update')->name('update');
Route::middleware('auth:api')->post('vehicles/{id}/delete','VehiclesController@destroy');
