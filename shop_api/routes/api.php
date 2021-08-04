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
});
