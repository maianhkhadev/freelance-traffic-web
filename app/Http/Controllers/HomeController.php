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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $week = Week::latest()->first();

        // $members = array();
        // $projects = array();
        // foreach($week->tasks as $task) {
        //   $index = array_search($task->member->id, array_column($members, 'id'));
        //   if ($index === FALSE) {
        //     $member = new \stdClass();
        //     $member->id = $task->member->id;
        //     $member->name = $task->member->name;
        //     $member->value = $task->value;
        //     array_push($members, $member);
        //   } else {
        //     $members[$index]->value += $task->value;
        //   }
        //
        //   $index = array_search($task->project->id, array_column($projects, 'id'));
        //   if ($index === FALSE) {
        //     $project = new \stdClass();
        //     $project->id = $task->project->id;
        //     $project->name = $task->project->name;
        //     $project->value = $task->value;
        //     array_push($projects, $project);
        //   } else {
        //     $projects[$index]->value += $task->value;
        //   }
        // }

        return view('home', ['week' => $week]);
    }
}
