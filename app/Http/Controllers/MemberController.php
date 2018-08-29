<?php

namespace App\Http\Controllers;

use App\Member;
use App\Week;
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
        $members = Member::orderBy('created_at', 'ASC')->get();
        return view('members.index', ['members' => $members]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $week_id = null)
    {
        $member = Member::find($id);

        $week = $week_id === null ? Week::latest()->first() : Week::find($week_id);
        $tasks = Task::where([ ['week_id', $week->id], ['member_id', $id] ])->get();

        $projects = array();
        foreach($tasks as $task) {

          $index = array_search($task->project->id, array_column($projects, 'id'));
          if ($index === FALSE) {
            $project = new \stdClass();
            $project->id = $task->project->id;
            $project->name = $task->project->name;
            $project->value = $task->value;
            array_push($projects, $project);
          } else {
            $projects[$index]->value += $task->value;
          }
        }

        $weeks = Week::orderBy('created_at', 'ASC')->get();

        return view('members.show', ['member' => $member, 'weeks' => $weeks, 'week' => $week, 'projects' => $projects, 'tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
        $member->disabled = $request->input('disabled') === 'on' ? true : false;

        $member->save();

        return redirect()->route('members.show', $member);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        return view('members.edit', ['member' => $member]);
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

        return redirect()->route('members.show', $member);
    }
}
