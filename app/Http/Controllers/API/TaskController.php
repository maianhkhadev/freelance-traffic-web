<?php

namespace App\Http\Controllers\API;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Task::orderBy('updated_at', 'ASC');

        if($request->has('member_ids')) {
            $member_ids = $request->input('member_ids');
            $query->whereIn('member_id', $member_ids);
        }

        if($request->has('project_ids')) {
            $project_ids = $request->input('project_ids');
            $query->whereIn('project_id', $project_ids);
        }

        if($request->has('week_ids')) {
            $week_ids = $request->input('week_ids');
            $query->whereIn('week_id', $week_ids);
        }

        if($request->has('name')) {
            $name = $request->input('name');
            $query->where('name', $name);
        }

        $tasks = $query->get();

        foreach($tasks as $index=>$task) {
          $task->team_id = $task->member->team->id;
          $task->team_name = $task->member->team->name;
          $task->member_name = $task->member->name;
          $task->project_name = $task->project->name;
          $task->project_color = $task->project->color;
          $task->week_name = $task->week->name;
        }

        return json_encode($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
