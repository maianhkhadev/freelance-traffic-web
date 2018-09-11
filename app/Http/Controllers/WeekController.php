<?php

namespace App\Http\Controllers;

use App\Project;
use App\Week;
use App\Team;
use App\Member;
use Illuminate\Http\Request;

class WeekController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weeks = Week::orderBy('created_at', 'ASC')->paginate(10);
        return view('weeks.index', ['weeks' => $weeks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $week = Week::find($id);
        $teams = Team::orderBy('created_at', 'ASC')->get();
        $projects = Project::leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')
                    ->where('tasks.week_id', $id)
                    ->select('projects.*')
                    ->distinct()
                    ->get();
        $members = Member::leftJoin('tasks', 'members.id', '=', 'tasks.member_id')
                    ->where('tasks.week_id', $id)
                    ->select('members.*')
                    ->distinct()
                    ->get();

        return view('weeks.show', ['teams' => $teams, 'week' => $week, 'projects' => $projects, 'members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('weeks.create');
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
        $week->closed = false;

        $week->save();

        return redirect()->route('weeks.show', $week);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $week = Week::find($id);
        return view('weeks.edit', ['week' => $week]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $week = Week::find($id);

        $week->name = $request->input('name');
        $week->closed = $request->input('closed') === 'on' ? true : false;

        $week->save();

        return redirect()->route('weeks.show', $week);
    }
}
