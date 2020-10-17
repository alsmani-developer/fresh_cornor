<?php
use App\Type;
use App\Field;
use App\Package;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Site\HomeController@index')->name('homepage');
Route::get('/change-lang/{val}', 'Site\HomeController@changeLanguage');
Route::get('/product/{id}', 'Site\ProductController@show');
Route::get('/product-search', 'Site\ProductController@searchProducts')->name('products.search-result');
Route::get('/products-advance-search', 'Site\ProductController@advSearchProducts')->name('products.adv-search-result');
Route::get('/products', 'Site\ProductController@index');
Route::get('/product/rating/{id}', 'Site\ProductController@fetchRating');
Route::get('/product/insert-rating/{id}', 'Site\ProductController@insertRating');
Route::get('/discount/{id}', 'Site\DiscountController@show');
Route::get('/discounts', 'Site\DiscountController@index');
Route::get('/category/{type}', 'Site\ProductController@category');
Route::get('/login', 'Site\UserController@login')->name('login');
Route::post('/login', 'Site\UserController@loginUser')->name('loginUser');
Route::get('/register', 'Site\UserController@register')->name('register');
Route::post('/register', 'Site\UserController@registerUserFirstStep')->name('registerUser');
Route::post('/add-favorite/{product_id}', 'Site\UserController@addToFav')->name('addToFav');
Route::post('/remove-favorite/{product_id}', 'Site\UserController@removeFromFav')->name('removeFromFav');
Route::post('/registerUserLastStep', 'Site\UserController@registerUserLastStep')->name('registerUserLastStep');
Route::get('/ajax/register-new-user-last-step', 'Site\UserController@registerUserLastStep');
Route::get('/logout', 'Site\UserController@logout');
Route::get('manege_types',function(){
    return view('vendor.multiauth.admin.pages.type');
})->name('types');

Route::get('manege_meat',function(){
    return view('vendor.multiauth.admin.pages.meats');
})->name('meats'); 

Route::get('manege_cattle_origin',function(){
    return view('vendor.multiauth.admin.pages.cattle_origin');
})->name('origin');

Route::get('manege_meat_shape',function(){
    return view('vendor.multiauth.admin.pages.meat_shape');
})->name('meat_shape');

Route::get('manege_meate_aera',function(){
    return view('vendor.multiauth.admin.pages.meate_area');
})->name('meat_aera');

Route::post('/add-to-cart', 'Site\ProductController@addToCart');
Route::get('/cart', 'Site\CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'Site\CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('checkout.cart.clear');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'Site\CheckoutController@getCheckout')->name('checkout.index');
    Route::get('/stripe-checkout/{order}', 'Site\CheckoutController@stripeCheckout');
    Route::post('/charge', 'Site\CheckoutController@charge');
    Route::post('/checkout/save-latlng', 'Site\CheckoutController@saveLatLng')->name('checkout.saveLatLng');
    Route::post('/checkout/order', 'Site\CheckoutController@placeOrder')->name('checkout.place.order');
    Route::get('/checkout/payment/complete', 'Site\CheckoutController@complete')->name('checkout.payment.complete');
    Route::get('/account/orders', 'Site\UserController@getOrders')->name('account.orders');
    Route::get('/user-profile', 'Site\UserController@getUser')->name('userProfile');
});


Route::get('manege_discounts',function(){
    return view('vendor.multiauth.admin.pages.discounts');
})->name('discounts');

Route::get('manege_orders',function(){
    return view('vendor.multiauth.admin.pages.orders');
})->name('orders');


Route::get('manege_users',function(){
    return view('vendor.multiauth.admin.pages.users');
})->name('users');

