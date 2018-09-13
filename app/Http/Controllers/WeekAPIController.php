<?php

namespace App\Http\Controllers;

use App\Week;
use Illuminate\Http\Request;

class WeekAPIController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        $weeks = Week::where('name', 'LIKE', '%'.$name.'%')->get();
        return json_encode($weeks);
    }
}
