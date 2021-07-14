<?php

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/homepage', 'HomePageController@getUserHomepage');
});

Route::get('/', ['as' => 'home', 'uses' => 'App\Http\Controllers\FrontEndController@getHome']);
//Route::post('/', ['as' => 'home', 'uses' => 'App\Http\Controllers\FrontEndController@postRegister']);

//login
Route::get('/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\FrontEndController@getLogin']);
Route::post('/login', 'App\Http\Controllers\FrontEndController@postRegister');

Route::get('/logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\FrontEndController@getLogout']);


Route::post('/add-frind', ['as' => 'add-frind', 'uses' => 'App\Http\Controllers\FrontEndController@postAddFriend']);

Route::get('/getMessage', ['as' => 'getMessage', 'uses' => 'App\Http\Controllers\FrontEndController@getMessage']);
Route::post('/postMessage', ['as' => 'postMessage', 'uses' => 'App\Http\Controllers\FrontEndController@postMessage']);
//Route::get('/getMessage', ['as' => 'getMessage', 'uses' => 'App\Http\Controllers\FrontEndController@getMessage']);
