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


    /** Allow Access After they have joined at least one team */
    Route::group(['middleware' => 'teamchooser'], function(){
        /** Bets */
        Route::resource('bets','BetsController',[

        ]);


        Route::resource('leagues','LeagueController',[]);
    });




    /** Teams */
    Route::resource('sports-teams','SportsTeamsController',[

    ]);

    /** Seasons */
    Route::resource('seasons','SeasonsController',[

    ]);


    /** LeaderBoard */
    Route::resource('leaderboard','LeaderBoardController',[
        'only'  =>  ['index']
    ]);


    /** Owners */
    Route::group(['prefix' => 'owners', 'middleware' => 'teamowner', 'as' => 'owners.'], function(){

        /** Bets */
        Route::resource('bets', 'Owners\BetsController',[
            'only'  =>  ['index']
        ]);


        /** Games */
        Route::resource('games', 'Owners\GamesController',[
            'only'  =>  ['index']
        ]);



    });


    /** Admins */
    Route::group(['prefix' => 'admins', 'middleware' => 'admins', 'as' => 'admins.'], function(){

        /** Games */
        Route::resource('games','Admins\GamesController',[
            'except'  =>  ['show']
        ]);

        /** Sports */
        Route::resource('sports','Admins\SportsController',[
            'except'    =>  ['show']
        ]);

        /** Leagues */
        Route::group(['prefix' => 'leagues', 'as' => 'leagues.'], function() {

            Route::group(['prefix' => '{id}/seasons', 'as' => 'seasons.'], function(){

                Route::post('update', array('as' => 'update', 'uses' => 'Admins\LeaguesController@updateSeasons'));
                Route::delete('destroy-all',array('as' => 'destroy-all', 'uses' => 'Admins\LeaguesController@destroyAllSeasons'));

            });

        });
        Route::resource('leagues','Admins\LeaguesController',[
            'except'    =>  ['show']
        ]);

        /** Teams */
        Route::resource('teams','Admins\TeamsController',[

        ]);

        /** Seasons */
        Route::resource('seasons','Admins\SeasonsController',[

        ]);

    });

});

/**
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
{
    Route::get('/', 'TeamController@index')->name('teams.index');
    Route::get('create', 'TeamController@create')->name('teams.create');
    Route::post('teams', 'TeamController@store')->name('teams.store');
    Route::get('edit/{id}', 'TeamController@edit')->name('teams.edit');
    Route::put('edit/{id}', 'TeamController@update')->name('teams.update');
    Route::delete('destroy/{id}', 'TeamController@destroy')->name('teams.destroy');
    Route::get('switch/{id}', 'TeamController@switchTeam')->name('teams.switch');

    Route::get('members/{id}', 'TeamMemberController@show')->name('teams.members.show');
    Route::get('members/resend/{invite_id}', 'TeamMemberController@resendInvite')->name('teams.members.resend_invite');
    Route::post('members/{id}', 'TeamMemberController@invite')->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', 'TeamMemberController@destroy')->name('teams.members.destroy');

    Route::get('accept/{token}', 'AuthController@acceptInvite')->name('teams.accept_invite');
});
