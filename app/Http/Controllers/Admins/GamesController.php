<?php

namespace App\Http\Controllers\Admins;


use App\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GamesController extends Controller
{


    const TEMPLATE_DIRECTORY = 'admins.games.';

    /**
     * Show all Games
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $games = Game::query()->paginate(10);
        return view(static::TEMPLATE_DIRECTORY . 'index',compact('games'));

    }



    public function create(Request $request)
    {

    }

}