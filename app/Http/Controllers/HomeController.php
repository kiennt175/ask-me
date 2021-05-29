<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        if($request->textSearch){
            $items = Question::search($request->input('textSearch'))->toArray();
        }

        dd($items);
    }
}
