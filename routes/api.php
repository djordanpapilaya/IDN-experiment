<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/resources', function (Request $request) {
	return $request->resource();
});

Route::prefix('v1')
	->namespace('Api\v1')
	->group( function () {
		Route::get('resources', 'ResourceController@index');
		Route::get('resource/{resource}', 'ResourceController@show');
		Route::get('user/session', 'UserController@sessionTime');
		Route::get('user/session/update', 'UserController@setUserSession');
		Route::post('event/route', 'RouteController@store');
		Route::post('event/video', 'ResourceController@storeVideo');
		Route::post('event/audio', 'ResourceController@storeAudio');
		Route::post('event/text', 'ResourceController@storeText');
		Route::post('event/time', 'ResourceController@storeTime');
		Route::post('route', 'RouteController@store');
		Route::post('logout', 'AuthenticatedSessionController@destroy');
});
