<?php

namespace App\Http\Controllers;

use App\Week;
use Carbon\Carbon;
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
        // check week
        $start_date = Carbon::now();
        $start_date->subWeek();

        $end_date = Carbon::now();
        $end_date->addWeeks(4);

        $weeks = Week::where([
          ['start_date', '>=', $start_date->startOfWeek()->format('Y-m-d')],
          ['end_date', '<=', $end_date->endOfWeek()->format('Y-m-d')],
          ['closed', true],
        ])->get();

        if(sizeof($weeks) > 0) {
          $weeks = Week::where('closed', false)->update(['closed' => false]);

          $weeks = Week::where([
            ['start_date', '>=', $start_date->startOfWeek()->format('Y-m-d')],
            ['end_date', '<=', $end_date->endOfWeek()->format('Y-m-d')],
          ])->update(['closed' => false]);
        }

        $date = Carbon::now();
        $week = Week::where([
          ['start_date', '>=', $date->startOfWeek()->format('Y-m-d')],
          ['end_date', '<=', $date->endOfWeek()->format('Y-m-d')],
          ['closed', false],
        ])->first();

        return view('home', ['week' => $week]);
    }
}
