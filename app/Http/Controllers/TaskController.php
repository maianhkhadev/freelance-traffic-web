<?php

namespace App\Http\Controllers;

use App\Name;
use App\Project;
use App\Week;
use App\Member;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $names = Name::where('table_name', 'Task')->get();
        $projects = Project::where('closed', 0)->get();
        $weeks = Week::where('closed', 0)->get();
        $members = Member::where('disabled', 0)->get();

        return view('tasks.create', ['names' => $names, 'projects' => $projects, 'weeks' => $weeks, 'members' => $members]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();

        $task->project_id = $request->input('project_id');
        $task->week_id = $request->input('week_id');
        $task->member_id = $request->input('member_id');
        $task->name = $request->input('name');
        $task->value = $request->input('value');
        $task->note = $request->input('note');
        $task->deleted = false;

        $task->save();

        return redirect()->route('home');
    }

    public function find(Request $request) {

      $week_id = $request->query('week_id');
      $member_id = $request->query('member_id');

      $tasks = Task::where([ ['week_id', $week_id], ['member_id', $member_id] ])->get();
      return $tasks;
    }
}
