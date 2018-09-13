<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectAPIController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        $projects = Project::where('name', 'LIKE', '%'.$name.'%')->get();
        return json_encode($projects);
    }
}
