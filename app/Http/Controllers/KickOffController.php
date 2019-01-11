<?php

namespace App\Http\Controllers;

use App\Project;
use App\Week;
use App\Member;
use App\Task;
use Illuminate\Http\Request;

class KickOffController extends Controller
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
        $projects = Project::where('closed', false)->get();
        $members = Member::where('disabled', false)->get();

        return view('kickoff', ['projects' => $projects, 'members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $week = new Week();

        $week->name = $request->input('name');
        $week->start_date = $request->input('start_date');

        $week->save();

        if ($request->has('names')) {
            $project_ids = $request->input('project_ids');
            $member_ids = $request->input('member_ids');
            $names = $request->input('names');
            $values = $request->input('values');
            $comments = $request->input('comments');

            for ($index = 0; $index < count($names); $index++) {
                $task = new Task();

                $task->project_id = $project_ids[$index];
                $task->week_id = $week->id;
                $task->member_id = $member_ids[$index];
                $task->name = $names[$index];
                $task->value = $values[$index];
                $task->comment = $comments[$index];

                $task->save();
            }
        }

        return redirect()->route('home');
    }
}
