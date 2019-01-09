<?php

namespace App\Http\Controllers;

use App\Week;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $week = Week::orderBy('start_date', 'DESC')->first();

        return view('home', ['week' => $week]);
    }
}
