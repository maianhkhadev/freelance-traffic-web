<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        $projects = Project::orderBy('created_at', 'ASC')->paginate(10);
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        $members = array();
        $weeks = array();
        foreach($project->tasks as $task) {
          $index = array_search($task->member->id, array_column($members, 'id'));
          if ($index === FALSE) {
            $member = new \stdClass();
            $member->id = $task->member->id;
            $member->name = $task->member->name;
            $member->value = $task->value;
            array_push($members, $member);
          } else {
            $members[$index]->value += $task->value;
          }

          $index = array_search($task->week->id, array_column($weeks, 'id'));
          if ($index === FALSE) {
            $week = new \stdClass();
            $week->id = $task->week->id;
            $week->name = $task->week->name;
            $week->value = $task->value;
            array_push($weeks, $week);
          } else {
            $weeks[$index]->value += $task->value;
          }
        }

        return view('projects.show', ['project' => $project, 'weeks' => $weeks, 'members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project();

        $project->name = $request->input('name');
        $project->color = $request->input('color');
        $project->closed = false;

        $project->save();

        return redirect()->route('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('projects.edit', ['project' => $project]);
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
        $project = Project::find($id);

        $project->name = $request->input('name');
        $project->closed = $request->input('closed') === 'on' ? true : false;

        $project->save();

        return redirect()->route('projects.index');
    }
}
