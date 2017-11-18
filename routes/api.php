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

Route::middleware('auth:api')->get(/**
 * @param Request $request
 * @return mixed
 */
    '/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->group(function() {

    Route::post('oauth/access_token', 'Auth\OAuth2Controller@issueToken');

});

Route::namespace('api')->group(function(){

	Route::post('/refresh', 'UserController@refresh');
	Route::post('/login','UserController@login');
	Route::post('/register','UserController@register');

	Route::middleware('auth:api')->group(function(){
		
		Route::post('/logout', 'UserController@logout');
		Route::get('/offers','OfferController@index');
		Route::post('/orders','OrderController@create');
		Route::put('/user_details/{id}', 'UserController@update_details');
        Route::get('/user_details/{id}', 'UserController@getDetails');
        Route::get('/user_orders/{id}', 'OrderController@orders_list_user');
		});
	
});

