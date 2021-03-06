<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Auth::routes();

Route::group([
  'namespace' => 'Api'
], function(){
  Route::get('/country', 'CountryController@index')->name('country.list');
  Route::post('/country/create', 'CountryController@store')->name('country.store');
  Route::post('/country/update/{id}', 'CountryController@update')->name('country.update');
  Route::delete('/country/delete/{id}', 'CountryController@destroy')->name('country.delete');

  Route::get('/user', 'UserController@index')->name('user.list');
  Route::post('/user/update/{id}', 'UserController@update')->name('user.update');

  Route::get('/blog','BlogController@index')->name('blog.list');
  Route::post('/blog/create','BlogController@store')->name('blog.create');
  Route::post('/blog/update/{id}','BlogController@update')->name('blog.update');
  Route::delete('/blog/delete/{id}', 'BlogController@destroy')->name(('blog.delete'));

  Route::post('/register', 'MemberController@register')->name('member.register');
  Route::post('/login','MemberController@login')->name('member.login');
});
