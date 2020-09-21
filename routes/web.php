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

Route::get('/', 'Site\HomeController@index');
Route::get('/change-lang/{val}', 'Site\HomeController@changeLanguage');
Route::get('/product', 'Site\ProductController@show');
Route::get('/products', 'Site\ProductController@index');
Route::get('/login', 'Site\UserController@login')->name('login');
Route::get('/register', 'Site\UserController@register')->name('register');


