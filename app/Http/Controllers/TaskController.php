<?php

namespace App\Http\Controllers;

use App\Project;
use App\Week;
use App\Member;
use App\Task;
use App\Hint;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Task::orderBy('updated_at', 'DESC');

        $search = $request->input('search');
        if($search !== NULL) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        $tasks = $query->paginate(10);

        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::where('closed', false)->get();
        $weeks = Week::where('closed', false)->get();
        $members = Member::where('disabled', false)->get();

        return view('tasks.create', ['projects' => $projects, 'weeks' => $weeks, 'members' => $members]);
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
        $task->comment = $request->input('comment');

        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $projects = Project::where('closed', false)->get();
        $weeks = Week::where('closed', false)->get();
        $members = Member::where('disabled', false)->get();

        return view('tasks.edit', ['task' => $task, 'projects' => $projects, 'weeks' => $weeks, 'members' => $members]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->project_id = $request->input('project_id');
        $task->week_id = $request->input('week_id');
        $task->member_id = $request->input('member_id');
        $task->name = $request->input('name');
        $task->value = $request->input('value');
        $task->comment = $request->input('comment');

        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
