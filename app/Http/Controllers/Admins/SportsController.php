<?php


namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\Sport;
use Illuminate\Validation\Rule;
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
    public function index(Request $request)
    {
        $sports = Sport::query()->paginate(10);
        return view(static::TEMPLATE_DIRECTORY . 'index',compact('sports'));
    }


    /**
     * Create a Sport
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view(static::TEMPLATE_DIRECTORY . 'create');
    }


    /**
     * Edit a Sport
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id){

        $sport = Sport::query()->findOrFail($id);

        return view(static::TEMPLATE_DIRECTORY . 'edit',compact('sport'));

    }


    /**
     * Store a Sport
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,static::RULES);

        Sport::query()->create([
            'name'  =>  $request->get('name')
        ]);

        return redirect()->route('admins.sports.index')
            ->with('success','Sport Created');
    }


    /**
     * Update a Sport
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name'  =>  Rule::unique('sports')->ignore($id,'id')
        );
        $this->validate($request, $rules);
        $sport = Sport::query()->findOrFail($id);

        $sport->fill($request->all());
        $sport->save();

        return redirect()->route('admins.sports.index')
            ->with('success','Sport Updated');
    }


}