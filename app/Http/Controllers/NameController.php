<?php

namespace App\Http\Controllers;

use App\Name;
use Illuminate\Http\Request;

class NameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table_name = $request->input('table_name');

        $names = Name::orderBy('table_name', $table_name)->paginate(15);
        return view('names.index', ['names' => $names]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('names.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = new Name();

        $name->value = $request->input('value');
        $name->table_name = 'Task';

        $name->save();

        return redirect()->route('names.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $name = Name::find($id);
        return view('names.edit', ['name' => $name]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = Name::find($id);

        $name->value = $request->input('value');
        $name->table_name = 'Task';

        $name->save();

        return redirect()->route('names.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy(Name $name)
    {
        //
    }
}
