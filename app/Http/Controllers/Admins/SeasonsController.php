<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\Season;
use App\Week;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{

    const TEMPLATE_DIRECTORY = 'admins.seasons.';


    /**
     * View All Seasons
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $seasons = Season::query()->paginate(10);
        return view(static::TEMPLATE_DIRECTORY . 'index',compact('seasons'));
    }


    /**
     * Show Create Page for Season
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view(static::TEMPLATE_DIRECTORY . 'create');
    }


    /**
     * Store a Season
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){

        $rules = array(
            'year'  =>  'integer|required|unique:seasons'
        );

        $this->validate($request, $rules);

        $season = Season::query()->create([
            'year'  =>  $request->get('year')
        ]);

        return redirect()->route('admins.seasons.index')
            ->with('success','Season Created');

    }


    /**
     * Edit a Season
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $season = Season::query()->findOrFail($id);
        $weeks = Week::all();

        return view(static::TEMPLATE_DIRECTORY . 'edit', compact('season','weeks'));
    }


}