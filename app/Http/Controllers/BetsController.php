<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BetsController extends Controller
{
    const TEMPLATE_DIRECTORY = 'bets.';



    public function index(Request $request){

        return view(static::TEMPLATE_DIRECTORY . 'index');

    }
}
