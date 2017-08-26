<?php
/**
 * Created by PhpStorm.
 * User: chrisvickers
 * Date: 8/25/17
 * Time: 8:22 PM
 */

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\League;
use App\Sport;
use Illuminate\Http\Request;

class LeaguesController extends Controller
{


    const TEMPLATE_DIRECTORY = 'admins.leagues.';


    /**
     * Show all Leagues
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $leagues = League::query()->paginate(10);
        return view(static::TEMPLATE_DIRECTORY . 'index',compact('leagues'));

    }


    /**
     * Add a League
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $sports = Sport::all();
        if($sports->count() == 0){
            return redirect()->route('admins.sports.create')
                ->with('error','Add a Sport before adding a league');
        }
        return view(static::TEMPLATE_DIRECTORY . 'create', compact('sports'));
    }



    public function store(Request $request){


    }


}