<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{

    const TEMPLATE_DIRECTORY = 'teams.';

    const rules = array(
        'name' => 'required',
        'city'  =>  'required'
    );


    /**
     * Show all Teams
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        $teams = Team::all();


        return view(static::TEMPLATE_DIRECTORY . 'index',compact('teams'));

    }



    public function create(Request $request){

        $this->middleware('permission:add-teams');

        return view(static::TEMPLATE_DIRECTORY . 'create');

    }
}
