<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\League;
use App\Season;
use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeaguesController extends Controller
{


    const TEMPLATE_DIRECTORY = 'admins.leagues.';


    const RULES = [
        'name'  =>  'required|unique:leagues,name',
        'sport_id'  =>  'required|integer|exists:sports,id'
    ];


    /**
     * Show all Leagues
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $leagues = League::with('sport')->paginate(10);
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


    /**
     * Store a new League
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $this->validate($request,static::RULES);

        League::query()->create($request->only(['name','sport_id']));

        return redirect()->route('admins.leagues.index')
            ->with('success','League Created');

    }


    /**
     * Edit a League
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $league = League::query()->findOrFail($id);
        $sports = Sport::all();
        $seasons = Season::all();
        return view(static::TEMPLATE_DIRECTORY . 'edit',compact('sports','league','seasons'));

    }


    /**
     * Update a League
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'name'  =>  Rule::unique('leagues')->ignore($id),
            'sport_id'  =>  'required|integer|exists:sports,id'
        ];
        $this->validate($request, $rules);

        $league = League::query()->findOrFail($id);

        $league->fill($request->all());
        $league->save();

        return redirect()->route('admins.leagues.index')
            ->with('success','League Updated');


    }


    /**
     * Delete a League
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id){

        $league = League::query()->findOrFail($id);

        $league->delete();

        return redirect()->route('admins.leagues.index')
            ->with('success','League Deleted');

    }



    public function updateSeasons(Request $request, $id)
    {
        $league = League::query()->findOrFail($id);
        $season_ids = $request->get('seasons');

        $league->seasons()->detach();
        foreach ($season_ids as $season_id){
            $season = Season::query()->findOrFail($season_id);
            $league->seasons()->attach($season);
        }

        return redirect()->back()->with('success','League Seasons Updated');

    }


}