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

//Vue js Api Route

Route::apiResources(
	[
		'type' => 'VueAPI\CattleTypeController'
	]
);

Route::apiResources(
	[
		'origin' => 'VueAPI\CattleOriginController'
	]
);

Route::apiResources(
	[
		'meat_aera' => 'VueAPI\MeatsAeraController'
	]
);

Route::apiResources(
	[
		'meat_shape' => 'VueAPI\MeatsShapeController'
	]
);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//user routes 
Route::post('login', 'Api\UserApi@login');
Route::post('verfy','Api\UserApi@verfyPhoneNumber');
Route::post('register', 'Api\UserApi@register');




Route::group(['middleware' => 'auth.jwt'], function () {
    //User JWT Routes
    Route::post('chang_pass/{user}','Api\UserApi@changePassword');
    Route::get('logout', 'ApiController@logout');
    Route::post('get_user', 'Api\UserApi@getUser');
    Route::post('add_proposal', 'Api\UserApi@add_proposal');
    

    //Orders JWT Routes
    Route::post('get_user_orders/{user}', 'Api\OrderApi@getUserOrder');
    Route::post('get_order/{order}', 'Api\OrderApi@getOrder');
    Route::post('add_order', 'Api\OrderApi@addOrder');
    Route::patch('cancel_order/{order}', 'Api\OrderApi@cancelOrder');
    Route::post('get_discount', 'Api\OrderApi@getDiscount');
    
});

