<?php

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


/** Auth Routes */
Auth::routes();
Route::get('/logout','Auth\LoginController@logout');

Route::get('/',['as' => 'home', 'uses' => 'HomeController@index']);


Route::group(['middleware' => 'auth'], function(){


    /** Bets */
    Route::resource('bets','BetsController',[

    ]);


    /** Teams */
    Route::resource('teams','TeamsController',[

    ]);

    /** Seasons */
    Route::resource('seasons','SeasonsController',[

    ]);


    /** LeaderBoard */
    Route::resource('leaderboard','LeaderBoardController',[
        'only'  =>  ['index']
    ]);

});