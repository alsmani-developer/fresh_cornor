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
Route::get('/product', 'Site\ProductController@show');
Route::get('/products', 'Site\ProductController@index');
Route::get('/category/{type}', 'Site\ProductController@category');
Route::get('/login', 'Site\UserController@login')->name('login');
Route::post('/login', 'Site\UserController@loginUser')->name('loginUser');
Route::get('/register', 'Site\UserController@register')->name('register');
Route::post('/register', 'Site\UserController@registerUserFirstStep')->name('registerUser');
// Route::post('/registerUserLastStep', 'Site\UserController@registerUserLastStep')->name('registerUserLastStep');
Route::get('/ajax/register-new-user-last-step', 'Site\UserController@registerUserLastStep');
Route::get('/logout', 'Site\UserController@logout');
Route::get('manege_types',function(){
    return view('vendor.multiauth.admin.pages.type');
})->name('types');

Route::get('manege_cattle_origin',function(){
    return view('vendor.multiauth.admin.pages.cattle_origin');
})->name('origin');

Route::get('manege_meat_shape',function(){
    return view('vendor.multiauth.admin.pages.meat_shape');
})->name('meat_shape');

Route::get('manege_meate_aera',function(){
    return view('vendor.multiauth.admin.pages.meate_area');
})->name('meat_aera');