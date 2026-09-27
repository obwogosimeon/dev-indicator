<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Level;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('levels.index', compact('levels'));
    }


    public function create()
    {
        return view('levels.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'level_name' => 'required',
            'name_plural' => 'required',
        ]);

        $input = $request->all();
        $level = Level::create($input);
        return redirect()->route('levels.index')
                        ->with('success','Level Created successfully');
    }

    public function show($id)
    {
        $levelshow = Level::find($id);
        return view('levels.show',compact('levelshow'));
    }

    public function edit($id)
    {
        $leveledit = Level::find($id);
        return view('levels.edit', compact('leveledit'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'level_name' => 'required',
            'name_plural' => 'required',
        ]);
        $input = $request->all();
        $level = Level::find($id);
        $level->update($input);
        return redirect()->route('levels.index')->with('success','Level Updated successfully');
    }
}
