<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\League;
use App\Sport;
use App\SportsTeam;
use Illuminate\Http\Request;

class TeamsController extends Controller
{

    const TEMPLATE_DIRECTORY = 'admins.teams.';


    /**
     * Show all Sports Teams
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sports_teams = SportsTeam::query()->paginate(10);

        return view(static::TEMPLATE_DIRECTORY . 'index',compact('sports_teams'));
    }



    public function create(Request $request){

        $leagues = League::with('sport')->get();
        $sports = Sport::all();
        return view(static::TEMPLATE_DIRECTORY . 'create',compact('leagues','sports'));

    }

}