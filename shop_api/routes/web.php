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
  'prefix' => 'admin'], function(){
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
});
