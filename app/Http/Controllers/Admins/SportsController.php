<?php


namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\League;
use App\Sport;
use Illuminate\Http\Request;

class SportsController extends Controller
{

    const TEMPLATE_DIRECTORY = 'admins.sports.';

    const RULES = [
        'name'  =>  'required|unique:sports,name'
    ];


    /**
     * Show all Sports
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){

        $sports = Sport::query()->paginate(10);


        return view(static::TEMPLATE_DIRECTORY . 'index',compact('sports'));

    }


    /**
     * Create a Sport
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request){

        return view(static::TEMPLATE_DIRECTORY . 'create');

    }



    public function store(Request $request){

        $this->validate($request,static::RULES);

        $sport = Sport::query()->create([
            'name'  =>  $request->get('name')
        ]);


        return redirect()->route('admins.sports.index')
            ->with('success','Sport Created');
    }


}