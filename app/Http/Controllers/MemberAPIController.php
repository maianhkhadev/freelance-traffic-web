<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberAPIController extends Controller
{
    public function search(Request $request)
    {
        $name = $request->input('name');

        $members = Member::where('name', 'LIKE', '%'.$name.'%')->get();
        return json_encode($members);
    }
}
