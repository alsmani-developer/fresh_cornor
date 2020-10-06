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
Route::get('get_meate','VueAPI\DiscountApi@getMeats')->name('get_meate');
Route::get('get_areas','VueAPI\MeatController@getArea')->name('get_area');
Route::get('get_shapes','VueAPI\MeatController@getShape')->name('get_shape');
Route::get('get_type','VueAPI\MeatController@getTypes')->name('get_type');
Route::get('get_origin','VueAPI\MeatController@getOrigins')->name('get_origin');
Route::post('upload_img','VueAPI\MeatController@uploadImg')->name('upload_img');

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
		'meat' => 'VueAPI\MeatController'
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
Route::apiResources(
	[
		'discount' => 'VueAPI\DiscountApi'
	]
);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get_orders','Api\OrderApi@getAllOrders')->name('get_orders');
Route::get('get_users','Api\UserApi@getAllUsers')->name('get_users');
//user routes 
Route::post('login', 'Api\UserApi@login');
Route::post('verfy','Api\UserApi@verfyPhoneNumber');
Route::post('register', 'Api\UserApi@register');
Route::get('get_code','Api\UserApi@getCode');




    //User JWT Routes
    Route::post('chang_pass/{user}','Api\UserApi@changePassword');
    Route::get('logout', 'ApiController@logout');
    Route::post('get_user', 'Api\UserApi@getUser');
    Route::post('add_proposal', 'Api\UserApi@add_proposal');
    Route::get('get_meat/{meat}','Api\OrderApi@getMeat');

    //Orders JWT Routes
    Route::post('get_user_orders/{user}', 'Api\OrderApi@getUserOrder');
    Route::post('get_order/{order}', 'Api\OrderApi@getOrder');
    Route::post('add_order', 'Api\OrderApi@addOrder');
    Route::patch('cancel_order/{order}', 'Api\OrderApi@cancelOrder');
    Route::post('get_discount', 'Api\OrderApi@getDiscount');
    


