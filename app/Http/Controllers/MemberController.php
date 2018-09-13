<?php

namespace App\Http\Controllers;

use App\Project;
use App\Week;
use App\Team;
use App\Member;
use App\Task;
use Illuminate\Http\Request;

class MemberController extends Controller
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
        $members = Member::orderBy('created_at', 'DESC')->paginate(10);
        return view('members.index', ['members' => $members]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        $projects = Project::leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')
                    ->where('tasks.member_id', $id)
                    ->select('projects.*')
                    ->distinct()
                    ->get();
        $weeks = Week::leftJoin('tasks', 'weeks.id', '=', 'tasks.week_id')
                    ->where('tasks.member_id', $id)
                    ->select('weeks.*')
                    ->distinct()
                    ->get();

        return view('members.show', ['member' => $member, 'projects' => $projects, 'weeks' => $weeks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        return view('members.create', ['teams' => $teams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Member();

        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->team_id = $request->input('team_id');
        $member->disabled = false;

        $member->save();

        return redirect()->route('members.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        $teams = Team::all();
        return view('members.edit', ['member' => $member, 'teams' => $teams]);
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
        $member = Member::find($id);

        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->disabled = $request->input('disabled') === 'on' ? true : false;

        $member->save();

        return redirect()->route('members.index');
    }
}
