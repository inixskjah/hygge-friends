<?php

use Illuminate\Http\Request;
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

Route::prefix('auth')->name('auth.')->group(function() {

    Route::post('login', 'AuthController@login')->name('login');

    Route::post('signup', 'AuthController@signup')->name('signup');

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:api')->group(function() {
    Route::prefix('friends')->name('friends.')->group(function() {

        Route::prefix('requests')->name('requests.')->group(function() {

            Route::get('/', 'FriendRequestController@index')->name('index');

            Route::post('/', 'FriendRequestController@store')->name('store');

            Route::delete('/{friendRequest}', 'FriendRequestController@destroy')->name('destroy');

            Route::post('/{friendRequest}/accept', 'FriendsController@store')->name('destroy');

        });

        Route::get('/', 'FriendsController@index')->name('index');

    });

    Route::prefix('users')->name('users.')->group(function() {

        Route::get('/', 'UsersController@index')->name('index');

    });
});
