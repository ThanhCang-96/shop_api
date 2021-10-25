<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group([
  'namespace' => 'Admin',
  'prefix' => 'admin'],
  function(){
  Route::get('/home', 'DashboardController@index')->name('home');

  // route country
  Route::get('/country', 'CountryController@index')->name('country.index');
  Route::get('/country/create', 'CountryController@create')->name('country.create');
  Route::post('/country/create', 'CountryController@store')->name('country.store');
  Route::get('/country/{id}/update', 'CountryController@edit')->name('country.edit');
  Route::post('/country/{id}/update', 'CountryController@update')->name('country.update');
  Route::get('/country/{id}/delete', 'CountryController@destroy')->name('country.delete');
  Route::get('/country/{id}/enable', 'CountryController@enableCountry')->name(('country.enable'));
  Route::get('/country/{id}/disable', 'CountryController@disableCountry')->name(('country.disable'));

  Route::get('/user', 'Usercontroller@index')->name('user.index');
  Route::get('/user/profile', 'Usercontroller@show')->name('user.show');
  Route::get('/user/{id}/update', 'UserController@edit')->name('user.edit');
  Route::post('/user/{id}/update', 'UserController@update')->name('user.update');
  Route::get('/user/{id}/delete', 'UserController@destroy')->name('user.delete');

  Route::get('/brand','BrandController@index')->name('brand.index');
  Route::get('/brand/create','BrandController@create')->name('brand.create');
  Route::post('/brand/create','BrandController@store')->name('brand.create');
  Route::get('/brand/{id}/update','BrandController@edit')->name('brand.edit');
  Route::post('/brand/{id}/update','BrandController@update')->name('brand.update');
  Route::get('/brand/{id}/delete','BrandController@destroy')->name('brand.delete');

  Route::get('/category','CategoryController@index')->name('category.index');
  Route::get('/category/create','CategoryController@create')->name('category.create');
  Route::post('/category/create','CategoryController@store')->name('category.create');
  Route::get('/category/{id}/update','CategoryController@edit')->name('category.edit');
  Route::post('/category/{id}/update','CategoryController@update')->name('category.update');
  Route::get('/category/{id}/delete','CategoryController@destroy')->name('category.delete');

  Route::get('/blog', 'BlogController@index')->name('blog.index');
});
